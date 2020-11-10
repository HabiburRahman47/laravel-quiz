<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Category')->group(function () {
    Route::patch('categories/{categoryId}/trash','CategoryController@trash');
    Route::patch('categories/{categoryId}/restore','CategoryController@restore');
    Route::get('categories/get-tree','CategoryController@getCategoryTree');
    Route::apiResource('categories', 'CategoryController');


});
