<?php

namespace App\Models\V1\Quiz;

use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizResult extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $table='quiz_results';
    protected $dates=['deleted_at'];
    public $searchable = ["id", "session_id"];
    public $sortable = ['id', 'updated_at', 'session_id'];
    protected $fillable=[
        'session_id',
        'total_question',
        'total_right_ans',
        'created_by_id'

        ];

    public function quizSession(){
        return $this->belongsTo(QuizSession::class,'id');
    }
}
