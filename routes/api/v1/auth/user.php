<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Auth')->group(function () {
    Route::get('/profile','UserController@profile');
});