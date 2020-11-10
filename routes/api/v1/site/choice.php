<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Choice')->group(function () {
    //Route for Choice
    Route::patch('choices/{choiceId}/trash','ChoiceController@trash');
    Route::patch('choices/{choiceId}/restore','ChoiceController@restore');
    Route::apiResource('choices', 'ChoiceController');

    //Route for Question-Choice Pivot table
    Route::post('questions/{questionId}/choices/{choiceId}/add','ChoiceQuestionController@attachChoiceToQuestion');
    Route::delete('questions/{questionId}/choices/{choiceId}/remove','ChoiceQuestionController@detachChoiceToQuestion');
    Route::get('question-choices/{questionChoiceId}','ChoiceQuestionController@show');

});
