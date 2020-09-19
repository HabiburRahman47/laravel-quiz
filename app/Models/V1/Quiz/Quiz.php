<?php

namespace App\Model\V1\Quiz;

use App\Model\V1\Choice\ChoiceQuestion;
use App\Model\V1\Question\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'name',
        'description',
        'config',
        'image'
    ];
    public function questions()
    {
       return $this->belongsToMany(Question::class);
    }
    public function choiceQuestion(){
        return $this->belongsTo(ChoiceQuestion::class);
    }


}
