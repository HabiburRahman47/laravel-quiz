<?php

namespace App\Http\Controllers\API\V1\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Admin\Question\QuestionQuizResource;
use App\Model\V1\Question\Question;
use App\Model\V1\Question\Question_Quiz;
use App\Model\V1\Quiz\Quiz;
use Illuminate\Http\Request;

class QuestionQuizController extends Controller
{
    public function attachQuestionToQuiz($quizId,$questionId){
        $quiz=Quiz::find($quizId);
        $question=Question::find($questionId);
        $quiz->questions()->attach($question);
        return response()->noContent();
    }

    public function detachQuestionFromQuiz($quizId,$questionId){
        $quiz=Quiz::find($quizId);
        $question=Question::find($questionId);
        $quiz->questions()->detach($question);
        return response()->noContent();
    }
    public function show($quizQuestionId){
        $quizQuestion=Question_Quiz::with('quiz','question')->findOrFail($quizQuestionId);
        return new QuestionQuizResource($quizQuestion);
    }
}
