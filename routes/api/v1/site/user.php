<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API\V1\Site')->group(function() {
    Route::middleware('auth:api', 'scope:manage-basic-properties')->group(function (){
        Route::apiResource('users', 'UserController');
    });
});