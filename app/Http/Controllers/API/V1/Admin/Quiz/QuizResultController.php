<?php

namespace App\Http\Controllers\API\V1\Admin\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizResultRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizResultResource;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Http\Request;

class QuizResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizResultRequest $request,$sessionId)
    {
        //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$sessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //Question
        $quizSession=QuizSession::findOrFail($sessionId);
        $quiz_id=$quizSession->quiz_id;
        $quiz=Quiz::with('questions')->findOrFail($quiz_id);
        $questions=$quiz->questions->pluck('config');
        $questionCount=$questions->count();
        $result=0;
        for($i=0;$i<$questionCount;$i++){
           if($questions[$i]==$quizSessionAns[$i]){
               $result++;
           }
        }
        $quizResult= new QuizResult();
        $quizResult->session_id=$sessionId;
        $quizResult->total_question=$questionCount;
        $quizResult->total_right_ans=$result;
        $quizResult->save();
        // return response($quizResult);
        return new QuizResultResource($quizResult);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizResult  $quizResult
     * @return \Illuminate\Http\Response
     */
    public function show($quizResultId)
    {

        //QuizResult
        $quizResult=QuizResult::findOrFail($quizResultId);
        $quizSessionId=$quizResult->session_id;
        //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$quizSessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //QuizSession
        $quizSession=QuizSession::findOrFail($quizSessionId);
        //Question with Choices
        $quizId=$quizSession->quiz_id;
        $quiz=Quiz::with('questions')->findOrFail($quizId);
        $questions=$quiz->questions;
        $questionLimit=$questions->count();
        $response=[];
        for($i=0;$i<$questionLimit;$i++){
            $questions[$i]['canditade_selected_ans'] = $quizSessionAns[$i];
            $response[] = [
                'question_with_choice' => $questions[$i],
            ];
        }
        $quizSession['question']=$response;
        return new QuizResultResource($quizSession);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizResult  $quizResult
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizResult $quizResult)
    {
        //
    }

}
