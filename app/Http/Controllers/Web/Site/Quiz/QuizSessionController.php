<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionResource;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Http\Request;

class QuizSessionController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Res
     * ponse
     */
    public function index()
    {
        $created_by_id = auth()->user()->id;
        $quizSessions=QuizSession::where('created_by_id','=',$created_by_id)
                 ->with('result')
                 ->get();
        return view('site.quizzes.showQuizHistory',compact('quizSessions'));
        // return new QuizSessionCollection($quizSessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$slug)
    {
        $created_by_id = auth()->user()->id;
        $quizQuestions=Quiz::with('questions.choices')->where('slug',$slug)->firstOrFail();
        $questions=$quizQuestions->questions;
        $quizSession=new QuizSession();
        $quizSession->quiz_name=$quizQuestions->name;
        $quizSession->quiz_id=$quizQuestions->id;
        $quizSession->created_by_id=$created_by_id;
        $quizSession->save();
        $sessionId=$quizSession->id;
        //return response()->json($quizQuestions);

        return view('site.quizzes.showQuestions',compact('questions','sessionId'));

    }
    //Display of Incomplete question
    public function displayIncompleteQuiz(Request $request,$sessionId)
    {
         //QuizSessionAns
        $quizSessionAns=QuizSessionAnswer::where('session_id','=',$sessionId)->get();
        $quizSessionAns=$quizSessionAns->pluck('selected_choice_id');
        //QuizSession
        $quizSession=QuizSession::findOrFail($sessionId);
        //Question with Choices
        $quizId=$quizSession->quiz_id;
        $quiz=Quiz::with('questions.choices')->findOrFail($quizId);
        $questions=$quiz->questions;
        $questionLimit=$questions->count();
        $response=[];
        for($i=0;$i<$questionLimit;$i++){
            $questions[$i]['canditade_selected_ans'] = isset($quizSessionAns[$i])?$quizSessionAns[$i]:null;
            $response[] = $questions[$i];
        }
        $quizSession['question']=$response;
        $questions=$quizSession->question;
        //return response()->json($quizQuestions);
        return view('site.quizzes.showQuestions',compact('questions','sessionId'));

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

}
