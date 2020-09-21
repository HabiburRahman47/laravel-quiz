<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Question')->group(function () {
    //Question
    Route::patch('questions/{questionId}/trash','QuestionController@trash');
    Route::patch('questions/{questionId}/restore','QuestionController@restore');
    Route::apiResource('questions', 'QuestionController');

    //Route for Question-Quiz Pivot table
    Route::post('quizzes/{quizId}/questions/{questionId}/add','QuestionQuizController@attachQuestionToQuiz');
    Route::delete('quizzes/{quizId}/questions/{questionId}/remove','QuestionController@detachQuestionToQuiz');
    Route::get('quiz-questions/{quizQuestionId}','QuestionQuizController@show');


});
