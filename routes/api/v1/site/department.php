<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Department')->group(function () {
    Route::patch('departments/{departmentId}/trash', 'DepartmentController@trash');
    Route::patch('departments/{departmentId}/restore', 'DepartmentController@restore');
    Route::apiResource('departments', 'DepartmentController');
});
