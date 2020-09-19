<?php

namespace App\Model\V1\Question;

use App\Model\V1\Choice\Choice;
use App\Model\V1\Choice\ChoiceQuestion;
use App\Model\V1\Quiz\Quiz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Question extends Model
{
    use SoftDeletes,HasTags;
    protected $dates=['deleted_at'];
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
}
