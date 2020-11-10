<?php

namespace App\Models\V1\Quiz;

use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizSession extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $table='quiz_sessions';
    protected $dates=['deleted_at'];
    public $searchable = ["id", "quiz_name"];
    public $sortable = ['id', 'updated_at', 'quiz_name'];
    protected $fillable=[
        'quiz_name',
        'quiz_id',
        'status'
    ];
    public function result(){
        return $this->belongsTo(QuizResult::class,'id');
    }

}
