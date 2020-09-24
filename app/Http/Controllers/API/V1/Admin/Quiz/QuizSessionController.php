<?php

namespace App\Http\Controllers\API\V1\Admin\Quiz;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizSessionRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionCollection;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionResource;
use App\Models\V1\Quiz\Quiz_Session;
use Illuminate\Http\Request;

class QuizSessionController extends AdminAPIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizSessions=Quiz_Session::all();
        return new QuizSessionCollection($quizSessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$quizId)
    {
        $created_by_id = auth()->user()->id;
        $quizSession= new Quiz_Session();
        $quizSession->quiz_id=$quizId;
        $quizSession->created_by_id=$created_by_id;
        $quizSession->save();
        return new QuizSessionResource($quizSession);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz_Session  $quiz_Session
     * @return \Illuminate\Http\Response
     */
    public function show($quizSessionId)
    {
        $quizSessionId=Quiz_Session::findOrFail($quizSessionId);
        return new QuizSessionResource($quizSessionId);
    }


    public function update(UpdateQuizSessionRequest $request,$quizSessionId)
    {
        $quizSession=Quiz_Session::findOrFail($quizSessionId);
        $quizSession->quiz_id=$request->input('quiz_id');
        $quizSession->created_by_id=$request->input('created_by_id');
        $quizSession->save();
        return new QuizSessionResource($quizSession);

    }

    public function trash($quizSessionId)
    {
        $quizSession=Quiz_Session::findOrFail($quizSessionId);
        //$this->authorize('trash',$quizSession);
        $quizSession->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($quizSessionId)
    {
        $quizSession=Quiz_Session::withTrashed()->findOrFail($quizSessionId);
        //$this->authorize('restore',$quizSession);
        $quizSession->restore();
        return new QuizSessionResource($quizSession);
    }

    //PERMANENT DELETE
    public function destroy($quizSessionId)
    {
        $quizSession=Quiz_Session::withTrashed()->findOrFail($quizSessionId);
        //$this->authorize('forceDelete',$quizSession);
        $quizSession->forceDelete();
        return response()->noContent();
    }
}
