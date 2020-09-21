<?php

namespace App\Http\Controllers\API\V1\Admin\Tag;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\QuestionTag\QuestionTagRequest;
use App\Http\Resources\API\V1\Admin\Question\QuestionResource;
use App\Models\V1\Question\Question;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class QuestionTagController extends AdminAPIBaseController
{
    //Using types
    public function syncTagsWithType(QuestionTagRequest $request,$questionId)
    {
        // $created_by_id = auth()->user()->id;
        $question= Question::findOrFail($questionId);
        $question->syncTagsWithType(explode(",",$request->categoryTags),'category');
        $question->syncTagsWithType(explode(",",$request->difficultyTags),'difficulty');

    }
    //Attaching Tags

    //Adding a single tags
    public function addSingleTagToQuestion(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        $question->attachTag($request->tag);
    }

    //Adding a multiple tags
    public function addMultipleTagToQuestion(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        $question->attachTags(explode(",",$request->tags));
    }

    //using an instance of \Spatie\Tags\Tag
    public function addTagToQuestionByTagModel(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        //$question->attachTags(explode(",",$request->tags));
        $question->attach(\Spatie\Tags\Tag::findOrCreate($request->tags));
    }

    //Detaching Tags
    //using a string
    public function detachSingleQuestionTag(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        $question->detachTag($request->tags);
    }
    //using a array
    public function detachMultipleQuestionTag(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        $question->detachTags(explode(",",$request->tags));
    }

    //Syncing Tags
    public function syncQuestionTags(QuestionTagRequest $request,$questionId){
        $question=Question::findOrFail($questionId);
        $question->syncTags(explode(",",$request->tags));
    }

    //Retrieving tagged models using withAnyTags
    public function retrieveTagWithQuestion(QuestionTagRequest $request){
        // dd($request->tags);
        $questionWithTag=Question::withAnyTags(explode(",",$request->tags))->get();
        return response($questionWithTag);
    }
    //Retrieving tagged models using withAnyTags and type
    public function retrieveTagAndTypeWithQuestion(QuestionTagRequest $request){
        $questionWithTag=Question::withAnyTags(explode(",",$request->tags),$request->type)->get();
        return response($questionWithTag);
    }
    //Retrieving tagged models using withAllTags
    public function retrieveTagWithAllQuestion(QuestionTagRequest $request){
        $questionWithTag=Question::withAllTags($request->tags)->get();
        return QuestionResource::collection($questionWithTag);
    }

    // public function retrieveQuestionsWithAnyTag(QuestionTagRequest $request){
    //     $questionWithTag=Question::withAnyTags(explode(",",$request->tags))->get();
    //     return QuestionResource::collection($questionWithTag);
    // }




}
