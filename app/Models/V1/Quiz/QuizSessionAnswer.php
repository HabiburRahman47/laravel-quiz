<?php

namespace App\Models\V1\Quiz;

use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizSessionAnswer extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id"];
    public $sortable = ['id', 'updated_at'];
    protected $fillable=[
        'session_id',
        'question_id',
        'selected_choice_id'
    ];
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
