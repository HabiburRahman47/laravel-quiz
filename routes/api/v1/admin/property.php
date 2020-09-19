<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Property')->group(function () {
        //property_type
        Route::patch('property-types/{id}/trash', 'PropertyTypeController@trash');
        Route::patch('property-types/{id}/restore', 'PropertyTypeController@restore');
        Route::apiResource('property-types', 'PropertyTypeController');

        //property
        Route::patch('properties/{id}/trash', 'Property\PropertyController@trash');
        Route::patch('properties/{id}/restore', 'PropertyController@restore');
        Route::apiResource('properties', 'PropertyController');
});
