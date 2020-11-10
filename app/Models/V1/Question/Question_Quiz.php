<?php

namespace App\Models\V1\Question;

use App\Models\V1\Quiz\Quiz;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question_Quiz extends Model
{
    protected $table='question_quiz';
    protected $dates=['deleted_at'];
    use SearchAble, SortAble, TrashFilterAble, PaginateAble,SoftDeletes;
    public $searchable = ["id", "quiz_id","question_id"];
    public $sortable = ['id', 'updated_at', 'question_id'];
    protected $fillable = [
        'quiz_id', 'question_id'
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function question(){
        return $this->belongsTo(Question::class,'question_id');
    }
    public function choice(){
        return $this->belongsTo(Choice::class);
    }

}
