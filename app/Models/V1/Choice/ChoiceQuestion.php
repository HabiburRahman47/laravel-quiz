<?php

namespace App\Models\V1\Choice;

use App\Models\V1\Question\Question;
use Illuminate\Database\Eloquent\Model;

class ChoiceQuestion extends Model
{
    protected $table='choice_question';
    public function question(){
        return $this->belongsTo(Question::class);

    }
}
