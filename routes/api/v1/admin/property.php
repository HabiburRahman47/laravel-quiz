<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API\V1\Admin\Property')->group(function () {
    Route::middleware('auth:api')->group(function () {
        //property_type
        Route::delete('property-type/{id}/trash', 'PropertyTypeController@trash');
        Route::patch('property-type/{id}/restore', 'PropertyTypeController@restore');
        Route::get('property-type/search', 'PropertyTypeController@search');
        Route::apiResource('property-type', 'PropertyTypeController');

        //property
        Route::delete('property/{id}/trash', 'Property\PropertyController@trash');
        Route::patch('property/{id}/restore', 'PropertyController@restore');
        Route::get('property/search', 'PropertyController@search');
        Route::apiResource('property', 'PropertyController');
    });
});
