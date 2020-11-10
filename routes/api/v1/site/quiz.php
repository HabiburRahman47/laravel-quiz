<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Quiz')->group(function () {
    Route::patch('quizzes/{quizId}/trash','QuizController@trash');
    Route::patch('quizzes/{quizId}/restore','QuizController@restore');
    Route::apiResource('quizzes', 'QuizController');

    //Quiz Session
    Route::post('quizzes/sessions/{quizId}/start','QuizSessionController@create');
    Route::post('quiz-sessions/{sessionId}/questions/{questionId}/choices/{choicedId}/submit','QuizSessionController@store');
    Route::get('quiz-session/{sessionId}/result','QuizSessionController@show');
    Route::get('quiz-session/previous-history','QuizSessionController@index');

    //Quiz Result
    Route::post('quiz-results/finish/{sessionId}','QuizResultController@store');
    Route::get('quiz-results/{quizResultId}','QuizResultController@show');


    //for practise
    // Route::get('quiz-results/update','QuizResultController@update');

    //Practise
    // Route::get('practice','QuizSessionAnswerController@show');

});





