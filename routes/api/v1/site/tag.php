<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->namespace('API\V1\Site\Tag')->group(function () {

        //QuestionTag...
        //Route for Question's Tag
        Route::post('questions/{questionId}/sync-tags-withType', 'QuestionTagController@syncTagsWithType');
        //Attaching tag with question
        Route::post('questions/{questionId}/addTag','QuestionTagController@attachTagToQuestion');
        Route::post('questions/{questionId}/addTags','QuestionTagController@attachTagsToQuestion');

        //Detaching tag with question
        Route::post('questions/{questionId}/tag/remove','QuestionTagController@detachSingleQuestionTag');
        Route::post('questions/{questionId}/tags/remove','QuestionTagController@detachMultipleQuestionTag');
        //Syncing Tags
        Route::post('questions/{questionId}/tags/sync','QuestionTagController@syncQuestionTags');
        //Retrieving tagged models

        //todo check tagName
        //Route::get('tags/{tagName}/questions/','QuestionTagController@retrieveTagWithQuestion');
        Route::post('questions/tag/retrieve','QuestionTagController@retrieveTagWithQuestion');
        Route::post('questions/tag-type/retrieve','QuestionTagController@retrieveTagAndTypeWithQuestion');
        Route::post('questions/tags/retrieve','QuestionTagController@retrieveTagWithAllQuestion');

        //Tag
        Route::apiResource('tags', 'TagController');

});
