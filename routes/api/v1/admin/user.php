<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\User')->group(function () {
    //Users
    Route::patch('users/{userId}/trash','UserController@trash');
    Route::patch('users{userId}/restore','UserController@restore');
    Route::get('users/{userId}/contacts','UserController@userWithUserContact');
    Route::apiResource('users', 'UserController');
    //UserContacts
    Route::patch('user-contacts/{userContactId}/trash','UserContactController@trash');
    Route::patch('user-contacts/{userContactId}/restore','UserContactController@restore');
    Route::apiResource('user-contacts','UserContactController');


    });
