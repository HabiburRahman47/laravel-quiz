<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API\V1\Admin\Property')->group(function () {
    Route::middleware('auth:api')->group(function () {
        //property_type
        Route::patch('property-type/{id}/trash', 'PropertyTypeController@trash');
        Route::patch('property-type/{id}/restore', 'PropertyTypeController@restore');
        Route::apiResource('property-type', 'PropertyTypeController');

        //property
        Route::patch('property/{id}/trash', 'Property\PropertyController@trash');
        Route::patch('property/{id}/restore', 'PropertyController@restore');
        Route::apiResource('property', 'PropertyController');
    });
});
