<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Admin\Section')->group(function () {

    Route::patch('sections/{sectionId}/trash','SectionController@trash');
    Route::patch('sections/{sectionId}/restore','SectionController@restore');
    Route::get('sections/{sectionId}/course-attendance','SectionController@showWithCourseAttendance');
    Route::post('sections/{sectionId}/courses/{courseId}/add','SectionController@attachCourseToSection');
    Route::delete('sections/{sectionId}/courses/{courseId}/remove','SectionController@detachCourseFromSection');
    Route::apiResource('sections','SectionController');

});
