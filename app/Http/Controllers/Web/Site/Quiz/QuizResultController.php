<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizResultRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizResultResource;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Http\Request;
use PDF;

class QuizResultController extends AdminBaseController
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
        dd("habibur");
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
        $quizResultId=$quizResult->id;
        // return response($quizResult);
        return new QuizResultResource($quizResult);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizResult  $quizResult
     * @return \Illuminate\Http\Response
     */
    public function show($sessionId)
    {

       //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$sessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //Question

        $quizSession=QuizSession::findOrFail($sessionId);
        $quizSession->status=1;
        $quizSession->save();
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
        //Quiz-Result
        $created_by_id = auth()->user()->id;
        $quizResult= new QuizResult();
        $quizResult->session_id=$sessionId;
        $quizResult->total_question=$questionCount;
        $quizResult->total_right_ans=$result;
        $quizResult->created_by_id=$created_by_id;
        $quizResult->save();
        $quizResultId=$quizResult->id;
        //Question and Selected choice 
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
        $quiz=Quiz::with('questions.choices')->findOrFail($quizId);
        $questions=$quiz->questions;
        $questionLimit=$questions->count();
        $response=[];
        for($i=0;$i<$questionLimit;$i++){
            $questions[$i]['canditade_selected_ans'] = $quizSessionAns[$i];
            $response[] = $questions[$i];
        }
        $quizSession['question']=$response;
        $questions=$quizSession->question;
        //return response()->json($quizSession->question);
    
        return view('site.quizzes.showQuizResult',compact('quizResult','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizResult  $quizResult
     * @return \Illuminate\Http\Response
     */
    public function pdfGeneration($sessionId)
    {
        //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$sessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //Question

        $quizSession=QuizSession::findOrFail($sessionId);
        $quizSession->status=1;
        $quizSession->save();
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
        //Quiz-Result
        $created_by_id = auth()->user()->id;
        $quizResult= new QuizResult();
        $quizResult->session_id=$sessionId;
        $quizResult->total_question=$questionCount;
        $quizResult->total_right_ans=$result;
        $quizResult->created_by_id=$created_by_id;
        $quizResult->save();
        $quizResultId=$quizResult->id;
        //Question and Selected choice 
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
        $quiz=Quiz::with('questions.choices')->findOrFail($quizId);
        $questions=$quiz->questions;
        $questionLimit=$questions->count();
        $response=[];
        for($i=0;$i<$questionLimit;$i++){
            $questions[$i]['canditade_selected_ans'] = $quizSessionAns[$i];
            $response[] = $questions[$i];
        }
        $quizSession['question']=$response;
        $questions=$quizSession->question;
        //pdf generation
        $pdf = PDF::loadView('site.quizzes.resultSheet',compact('quizResult','questions'));
        $pdf->stream('resultSheet.pdf');
        return $pdf->download('resultSheet.pdf');
    }

}
