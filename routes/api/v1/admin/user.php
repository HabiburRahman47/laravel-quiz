<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API\V1\Admin\User')->group(function() {
    Route::middleware('auth:api')->group(function (){
        Route::apiResource('users', 'UserController');
    });
});
