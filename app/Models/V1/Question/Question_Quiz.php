<?php

namespace App\Model\V1\Question;

use App\Model\V1\Quiz\Quiz;
use Illuminate\Database\Eloquent\Model;

class Question_Quiz extends Model
{
    protected $table='question_quiz';
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function choice(){
        return $this->belongsTo(Choice::class);
    }

}
