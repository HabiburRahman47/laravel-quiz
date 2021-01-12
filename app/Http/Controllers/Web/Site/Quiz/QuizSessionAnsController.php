<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizSessionRequest;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionAnswerResource;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionResource;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Http\Request;

class QuizSessionAnsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $created_by_id = auth()->user()->id;
        $quizSessions=QuizSession::where('created_by_id','=',$created_by_id)
                 ->with('result')
                 ->get();
        // $sessionId=$quizSessions->pluck('id');
        // $quizResults=QuizResult::select('total_question','total_right_ans')
        //              ->whereIn('session_id',$sessionId)
        //              ->get();
        // $quizSessions['quiz_result']=$quizResults;
        return response()->json($quizSessions);
        // return new QuizSessionCollection($quizSessions);
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
    public function store(Request $request,$sessionId)
    {
       
        foreach($request->input('questions', []) as $key => $question){
            QuizSessionAnswer::create([
                'session_id'=> $sessionId,
                'question_id' => $question,
                'selected_choice_id'   => $request->input('choice.'.$question),
                 'created_by_id'=> auth()->user()->id,
            ]);
        }//QuizSessionAns
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
        //Quiz-Result
        $created_by_id = auth()->user()->id;
        $quizResult= new QuizResult();
        $quizResult->session_id=$sessionId;
        $quizResult->total_question=$questionCount;
        $quizResult->total_right_ans=$result;
        $quizResult->created_by_id=$created_by_id;
        $quizResult->save();
        $quizResultId=$quizResult->id;
    
        return view('site.quizzes.showQuizResult',compact('quizResult'));

    }

    public function incompleteSession(Request $request,$sessionId)
    {
       
        foreach($request->input('questions', []) as $key1 => $question){
            foreach($request->input('choice', []) as $key2 => $choice){
                if($key2==$question){
                    QuizSessionAnswer::create([
                        'session_id'=> $sessionId,
                        'question_id' => $question,
                        'selected_choice_id'   => $request->input('choice.'.$question),
                        'created_by_id'=> auth()->user()->id,
                    ]);
                }
            }           
        }
        $quizSession = QuizSession::findOrFail($sessionId);
        $quizSession->status=1;
        $quizSession->save();
        
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
    
}
