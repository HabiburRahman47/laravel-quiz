<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Attendance')->group(function () {

    Route::patch('attendances/{attendanceId}/trash','AttendanceController@trash');
    Route::patch('attendances/{attendanceId}/restore','AttendanceController@restore');
    Route::get('attendances/{attendanceId}/course-section','AttendanceController@showWithCourseSection');
    Route::apiResource('attendances', 'AttendanceController');
});
