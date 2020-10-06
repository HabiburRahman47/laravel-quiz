<?php

namespace App\Models\V1\Question;

use App\Models\V1\Choice\Choice;
use App\Models\V1\Choice\ChoiceQuestion;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Question extends Model
{
    use SoftDeletes,HasTags,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'name',
        'config',
        'question_type',
        'suggested'
    ];
    public function quizzes()
    {
       return $this->belongsToMany(Quiz::class);
    }
    public function choices(){
        return $this->belongsToMany(Choice::class);
    }
    public function choice(){
        return $this->hasMany(Choice::class);
    }
    public function quizSessionAns(){
        return $this->belongsTo(QuizSessionAnswer::class,'id');
    }
}
