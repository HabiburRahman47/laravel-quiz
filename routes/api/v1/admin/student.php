<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Student')->group(function () {
    Route::patch('students/{studentId}/trash','StudentController@trash');
    Route::patch('students/{studentId}/restore','StudentController@restore');
    Route::apiResource('students', 'StudentController');

});
