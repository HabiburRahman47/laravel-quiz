<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Card')->group(function () {
    Route::patch('cards/{cardId}/trash','CardController@trash');
    Route::patch('cards/{cardId}/restore','CardController@restore');
    Route::get('cards/{cardId}/with-user','CardController@findOutUsers');
    Route::post('cards/students/{studentId}','CardController@storeStudentToCards');
    Route::apiResource('cards', 'CardController');

});
