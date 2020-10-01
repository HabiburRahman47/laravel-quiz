<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Quiz')->group(function () {
    Route::patch('quizzes/{quizId}/trash','QuizController@trash');
    Route::patch('quizzes/{quizId}/restore','QuizController@restore');
    Route::apiResource('quizzes', 'QuizController');

    //Quiz Session
    Route::post('quizzes/sessions/{quizId}/start','QuizSessionController@create');
    Route::post('quiz-session-answers/{questionId}/{selectedId}/{sessionId}/submit','QuizSessionController@store');
    //Quiz Result
    Route::post('quiz-results/finish/{sessionId}','QuizResultController@store');
    Route::get('quiz-results/{quizResultId}','QuizResultController@show');
    //for practise
    Route::get('quiz-results','QuizResultController@practise');

    // //Admin
    // Route::patch('quiz-sessions/{quizSessionId}/trash','QuizSessionController@trash');
    // Route::patch('quiz-sessions/{quizSessionId}/restore','QuizSessionController@restore');
    // Route::apiResource('quiz-sessions','QuizSessionController');

    // //Quiz Session Answer
    // //admin
    // Route::patch('quiz-session-answers/{quizSessionAnsId}/trash','QuizSessionAnswerController@trash');
    // Route::patch('quiz-session-answers/{quizSessionAnsId}/restore','QuizSessionAnswerController@restore');
    // Route::apiResource('quiz-session-answers','QuizSessionAnswerController');


    //Practise
    Route::get('practice','QuizSessionAnswerController@show');

});





