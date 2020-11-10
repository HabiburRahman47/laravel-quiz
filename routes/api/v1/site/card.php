<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Card')->group(function () {
    Route::patch('cards/{cardId}/trash','CardController@trash');
    Route::patch('cards/{cardId}/restore','CardController@restore');
    Route::apiResource('cards', 'CardController');

});
