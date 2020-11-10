<?php

namespace App\Http\Controllers\API\V1\Site\Question;

use App\Http\Controllers\API\V1\Site\AdminAPIBaseController;
use App\Http\Requests\API\V1\Site\Question\StoreQuestionRequest;
use App\Http\Requests\API\V1\Site\Question\UpdateQuestionRequest;
use App\Http\Resources\API\V1\Site\Question\QuestionCollection;
use App\Http\Resources\API\V1\Site\Question\QuestionResource;
use App\Models\V1\Question\Question;
use Illuminate\Http\Request;

class QuestionController extends AdminAPIBaseController
{
    public function index(Request $request)
    {
        $questions = Question::query();
        if (!empty($request->tags)) {
            $questions->withAnyTags(explode(",", $request->tags));
        }

        return new QuestionCollection($questions->get());
    }

    public function store(StoreQuestionRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $question = new Question();
        $question->fill($request->all());
        $question->created_by_id = $created_by_id;
        $question->save();
        return new QuestionResource($question);
    }

    public function show($questionId)
    {
        $question = Question::with('choices')->findOrFail($questionId);
        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, $questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->fill($request->all());
        $this->authorize('update',$question);
        $question->save();
        return new QuestionResource($question);
    }

    public function trash($questionId)
    {
        $question = Question::findOrFail($questionId);
        $this->authorize('trash',$question);
        $question->delete();
        return response()->noContent();
    }

    public function restore($questionId)
    {
        $question = Question::withTrashed()->findOrFail($questionId);
        $this->authorize('restore',$question);
        $question->restore();
        return new QuestionResource($question);
    }

    public function destroy($questionId)
    {
        $question = Question::withTrashed()->findOrFail($questionId);
        $this->authorize('forceDelete',$question);
        $question->forceDelete();
        return response()->noContent();
    }
}
