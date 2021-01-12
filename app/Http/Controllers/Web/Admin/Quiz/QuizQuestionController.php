<?php

namespace App\Http\Controllers\Web\Admin\Quiz;


use App\DataTables\Quiz\QuizQuestionDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizQuestionRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizQuestionRequest;
use App\Models\V1\Question\Question;
use App\Models\V1\Question\Question_Quiz;
use App\Models\V1\Quiz\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuizQuestionDataTable $dataTable)
    {
        $questions = Question::get();
        $quizzes = Quiz::get();
        return $dataTable->render('admin.quiz-questions.index', compact('questions','quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $quizzes = Quiz::where('created_by_id', auth()->user()->id)->get();
        return view('admin.quiz-questions.create', compact('questions', 'quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizQuestionRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $quizQuestion = Question_Quiz::where('quiz_id',$request->quiz_id)->where('question_id',$request->question_id)->first();
        if (!empty($quizQuestion)){
            $this->flashAlreadyCreatedMsg(route('web.admin.quiz-questions.edit',$quizQuestion->id));
            return redirect()->back()->with(['rID' => $quizQuestion->id]);
        }
        $quizQuestion = new Question_Quiz();
        $quizQuestion->fill($request->all());
        $quizQuestion->created_by_id=$created_by_id;
        $quizQuestion->save();
        // $quizQuestion->setMeta('seo', json_encode($request->seo));

        $displayUrl = route('web.admin.quiz-questions.show', $quizQuestion->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quizQuestion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizQuestion = Question_Quiz::with('question','quiz')->findOrFail($id);
        return view('admin.quiz-questions.show', compact('quizQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $quizzes = Quiz::where('created_by_id', auth()->user()->id)->get();
        $quizQuestion = Question_Quiz::findOrFail($id);
        // $seo = json_decode($quizQuestion->getMeta('seo'));

        return view('admin.quiz-questions.edit', compact('quizzes', 'questions','quizQuestion'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizQuestionRequest $request, $id)
    {
        $quizQuestion = Question_Quiz::findOrFail($id);
        $quizQuestion->fill($request->all());
        $this->authorize('update',$quizQuestion);
        $quizQuestion->save();
        $displayUrl = route('web.admin.quiz-questions.show', $quizQuestion->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quizQuestion->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quizQuestion = Question_Quiz::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$quizQuestion);
        $quizQuestion->forceDelete();
        return response()->json("success");
    }

    public function trash($id)
    {
        $quizQuestion = Question_Quiz::find($id);
        $this->authorize('trash',$quizQuestion);
        $quizQuestion->delete();
        return response()->noContent();
    }

    public function restore($id)
    {
        $quizQuestion = Question_Quiz::withTrashed()->findOrFail($id);
        $this->authorize('restore',$quizQuestion);
        $quizQuestion->restore();
        return response()->noContent();
    }
}
