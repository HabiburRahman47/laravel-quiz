<?php

namespace App\Http\Controllers\API\V1\Admin\Choice;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Admin\Choice\ChoiceQuestionResource;
use App\Models\V1\Choice\Choice;
use App\Models\V1\Choice\ChoiceQuestion;
use App\Models\V1\Question\Question;
use Illuminate\Http\Request;

class ChoiceQuestionController extends Controller
{
    public function attachChoiceToQuestion($choiceId,$questionId){
        $choice=Choice::find($choiceId);
        $question=Question::find($questionId);
        $question->choices()->attach($choice);
        return response()->noContent();
    }

    public function detachChoiceFromQuestion($choiceId,$questionId){
        $choice=Choice::find($choiceId);
        $question=Question::find($questionId);
        $question->choices()->detach($choice);
        return response()->noContent();
    }
    public function show($questionChoiceId){
        $choiceQuestion=ChoiceQuestion::findOrFail($questionChoiceId);
        return new ChoiceQuestionResource($choiceQuestion);
    }
}
