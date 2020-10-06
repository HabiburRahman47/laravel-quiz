<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Category')->group(function () {
    Route::patch('categories/{categoryId}/trash','CategoryController@trash');
    Route::patch('categories/{categoryId}/restore','CategoryController@restore');
    Route::apiResource('categories', 'CategoryController');

});
