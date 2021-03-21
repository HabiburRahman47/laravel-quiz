<?php

namespace App\Http\Controllers\API\V1\Admin\Quiz;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizCollection;
use App\Http\Resources\API\V1\Admin\Quiz\QuizResource;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\User\User;
use Illuminate\Http\Request;

class QuizController extends AdminAPIBaseController
{
    public function index(Request $request)
    {
       // $quizzes=Quiz::applyTrashFilterAble()
       //          ->applyKeywordSearchAble()
       //          ->applySortAble()
       //          ->applyPaginateAble();
       // return new QuizCollection($quizzes);
        return response()->json(Quiz::with('category')->get());
    }


    public function store(StoreQuizRequest $request)
    {
        // $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        //Create a quiz data
        $quiz=new Quiz();
        $quiz->fill($request->all());
        $quiz->created_by_id=$created_by_id;
        $quiz->save();
        return new QuizResource($quiz);
    }

    public function show($quizId)
    {
        $quiz=Quiz::with('questions.choices','category')->findOrFail($quizId);
        // return new QuizResource($quiz);
        return response()->json($quiz);
    }

    public function update(UpdateQuizRequest $request,$quizId)
    {
        $quiz=Quiz::findOrFail($quizId);
        $quiz->fill($request->all());
        // $this->authorize('update',$quiz);
        $quiz->save();
        return new QuizResource($quiz);
    }



    public function trash($quizId)
    {
        // return response()->json('Successful');
        $quiz=Quiz::findOrFail($quizId);
        // $this->authorize('trash',$quiz);
        $quiz->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($quizId)
    {
        $quiz=Quiz::withTrashed()->findOrFail($quizId);
        $this->authorize('restore',$quiz);
        $quiz->restore();
        return new QuizResource($quiz);
    }

    //PERMANENT DELETE
    public function destroy($quizId)
    {
        $quiz=Quiz::withTrashed()->findOrFail($quizId);
        $this->authorize('forceDelete',$quiz);
        $quiz->forceDelete();
        return response()->noContent();
    }
    public function profile(Request $request)
	{
		
		$user =User::findOrFail(auth()->user()->id);
		return response()->json($user);
	}
}
