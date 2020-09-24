<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Quiz')->group(function () {
    Route::patch('quizzes/{quizId}/trash','QuizController@trash');
    Route::patch('quizzes/{quizId}/restore','QuizController@restore');
    Route::apiResource('quizzes', 'QuizController');

    //Quiz Session
    Route::post('quizzes/sessions/{quizId}/start','QuizSessionController@create');
    Route::get('quizzes/sessions/{quizSessionId}','QuizSessionController@show');
    Route::get('quiz-sessions','QuizSessionController@index');
    Route::put('quiz-sessions/{quizSessionId}/update','QuizSessionController@update');
    Route::patch('quiz-sessions/{quizSessionId}/trash','QuizSessionController@trash');
    Route::patch('quiz-sessions/{quizSessionId}/restore','QuizSessionController@restore');
    Route::delete('quiz-sessions/{quizSessionId}/delete','QuizSessionController@destroy');
});





