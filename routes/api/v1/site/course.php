<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Course')->group(function () {
    //Course
    Route::patch('courses/{courseId}/trash','CourseController@trash');
    Route::patch('courses/{courseId}/restore','CourseController@restore');
    Route::apiResource('courses', 'CourseController');
    //Course-Section-Teacher
    Route::patch('course-section-teachers/{courseSectionTeacherId}/trash','CourseSectionTeacherController@trash');
    Route::patch('course-section-teachers/{courseSectionTeacherId}/restore','CourseSectionTeacherController@restore');
    Route::apiResource('course-section-teachers', 'CourseSectionTeacherController');
    //Route for CourseSection
    Route::get('course-sections/{courseSectionId}','CourseSectionController@show');



});
