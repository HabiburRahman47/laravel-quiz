<?php

namespace App\Http\Controllers\API\V1\Admin\Quiz;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizSessionAnswerRequest;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizSessionRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizSessionRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionAnswerResource;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionCollection;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionResource;
use App\Models\V1\Question\Question;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
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
        $quizSessions=QuizSession::all();
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
        $quiz=Quiz::findOrFail($quizId);
        $quizSession=new QuizSession();
        $quizSession->quiz_name=$quiz->name;
        $quizSession->quiz_id=$quizId;
        $quizSession->created_by_id=$created_by_id;
        $quizSession->save();
        // return response($quizSession);
        return new QuizSessionResource($quizSession);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizSessionAnswerRequest $request,$questionId,$selectedId,$sessionId)
    {
        $session_id =Session()->get('id');
        $quizSessionAns= new QuizSessionAnswer();
        $quizSessionAns->session_id=$sessionId;
        $quizSessionAns->question_id=$questionId;
        $quizSessionAns->selected_choice_id=$selectedId;
        $quizSessionAns->save();
        return new QuizSessionAnswerResource($quizSessionAns);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizSession  $QuizSession
     * @return \Illuminate\Http\Response
     */
    public function show($sessionId)
    {
        //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$sessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //Question
        $quizSession=QuizSession::findOrFail($sessionId);
        $quiz_id=$quizSession->quiz_id;
        $quiz=Quiz::with('questions')->findOrFail($quiz_id);
        $questions=$quiz->questions->pluck('config');
        $count=$questions->count();
        $result=0;
        for($i=0;$i<$count;$i++){
           if($questions[$i]==$quizSessionAns[$i]){
               $result++;
           }
        }
        $quizSession['total_question_number']=$count;
        $quizSession['right_total_question_number']=$result;
        return new QuizSessionResource($quizSession);
    }


    public function update(UpdateQuizSessionRequest $request,$quizSessionId)
    {
        $quizSession=QuizSession::findOrFail($quizSessionId);
        $quizSession->fill($request->all());
        $quizSession->save();
        return new QuizSessionResource($quizSession,);

    }

    public function trash($quizSessionId)
    {
        $quizSession=QuizSession::findOrFail($quizSessionId);
        //$this->authorize('trash',$quizSession);
        $quizSession->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($quizSessionId)
    {
        $quizSession=QuizSession::withTrashed()->findOrFail($quizSessionId);
        //$this->authorize('restore',$quizSession);
        $quizSession->restore();
        return new QuizSessionResource($quizSession);
    }

    //PERMANENT DELETE
    public function destroy($quizSessionId)
    {
        $quizSession=QuizSession::withTrashed()->findOrFail($quizSessionId);
        //$this->authorize('forceDelete',$quizSession);
        $quizSession->forceDelete();
        return response()->noContent();
    }
}
