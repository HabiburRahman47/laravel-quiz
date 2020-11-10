<?php

namespace App\Http\Controllers\API\V1\Site\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Site\Quiz\StoreQuizSessionAnswerRequest;
use App\Http\Requests\API\V1\Site\Quiz\UpdateQuizSessionAnswerRequest;
use App\Http\Resources\API\V1\Site\Quiz\QuizSessionAnswerCollection;
use App\Http\Resources\API\V1\Site\Quiz\QuizSessionAnswerResource;
use App\Models\V1\Question\Question;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizSessionAnswerController extends Controller
{

    public function index()
    {
       $quizSessionAnswers=QuizSessionAnswer::applyTrashFilterAble()
                ->applyKeywordSearchAble()
                ->applySortAble()
                ->applyPaginateAble();
       return new QuizSessionAnswerCollection($quizSessionAnswers);
    }


    public function store(StoreQuizSessionAnswerRequest $request,$questionId,$selectedId)
    {

        $session_id =Session()->get('id');
        $quizSessionAns= new QuizSessionAnswer();
        $quizSessionAns->session_id=$session_id;
        $quizSessionAns->question_id=$questionId;
        $quizSessionAns->selected_choice_id=$selectedId;
        $quizSessionAns->save();
        dd($quizSessionAns);

        //Create a quizSessionAnswer data
        // $quizSessionAns=new QuizSessionAnswer();
        // $quizSessionAns->session_id=$request->session()->put('session_id');
        // $quizSessionAns->fill($request->all());
        // $quizSessionAns->save();
        // return new QuizSessionAnswerResource($quizSessionAns);
    }

    public function show(Request $request)
    {
        $count= Question::count();
        dd($count);
    }

    public function update(UpdateQuizSessionAnswerRequest $request,$quizSessionAnsId)
    {
        $quizSessionAns=QuizSessionAnswer::findOrFail($quizSessionAnsId);
        $quizSessionAns->fill($request->all());
        // $this->authorize('update',$quizSessionAns);
        $quizSessionAns->save();
        return new QuizSessionAnswerResource($quizSessionAns);
    }



    public function trash($quizSessionAnsId)
    {
        $quizSessionAns=QuizSessionAnswer::findOrFail($quizSessionAnsId);
        // $this->authorize('trash',$quizSessionAns);
        $quizSessionAns->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($quizSessionAnsId)
    {
        $quizSessionAns=QuizSessionAnswer::withTrashed()->findOrFail($quizSessionAnsId);
        //$this->authorize('restore',$quizSessionAns);
        $quizSessionAns->restore();
        return new QuizSessionAnswerResource($quizSessionAns);
    }

    //PERMANENT DELETE
    public function destroy($quizSessionAnsId)
    {
        $quizSessionAns=QuizSessionAnswer::withTrashed()->findOrFail($quizSessionAnsId);
        //$this->authorize('forceDelete',$quizSessionAns);
        $quizSessionAns->forceDelete();
        return response()->noContent();
    }
}
