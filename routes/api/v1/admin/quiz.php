<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Quiz')->group(function () {
    Route::patch('quizzes/{quizId}/trash','QuizController@trash');
    Route::patch('quizzes/{quizId}/restore','QuizController@restore');
    Route::apiResource('quizzes', 'QuizController');

});
