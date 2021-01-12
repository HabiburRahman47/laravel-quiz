<?php

namespace App\Http\Controllers\Web\Admin\Quiz;

use App\DataTables\Quiz\QuizSessionAnswerDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizSessionAnswerRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizSessionAnswerRequest;
use App\Models\V1\Choice\Choice;
use App\Models\V1\Question\Question;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;

class QuizSessionAnswerController extends AdminBaseController
{

    public function index(QuizSessionAnswerDataTable $dataTable)
    {
        return $dataTable->render('admin.quiz-session-answers.index');
    }

    public function create()
    {
        $quizSessions = QuizSession::where('created_by_id', auth()->user()->id)->get();
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $choices = Choice::where('created_by_id', auth()->user()->id)->get();
        return view('admin.quiz-session-answers.create', compact('quizSessions','questions','choices'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreQuizSessionAnswerRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $quizSessionAns = new QuizSessionAnswer();
        $quizSessionAns->fill($request->all());
        $quizSessionAns->created_by_id=$created_by_id;
        $quizSessionAns->save();


        $displayUrl = route('web.admin.quiz-session-answers.show', $quizSessionAns->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$quizSessionAns->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $quizSessions = QuizSession::where('created_by_id', auth()->user()->id)->get();
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $choices = Choice::where('created_by_id', auth()->user()->id)->get();
        $quizSessionAns = QuizSessionAnswer::findOrFail($id);
        // $this->authorize('show',$quizSessionAns);
        return view('admin.quiz-session-answers.show', compact('quizSessions','questions','choices','quizSessionAns'));
    }

    public function edit($id)
    {
        $quizSessions = QuizSession::where('created_by_id', auth()->user()->id)->get();
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $choices = Choice::where('created_by_id', auth()->user()->id)->get();
        $quizSessionAns = QuizSessionAnswer::findOrFail($id);
        return view('admin.quiz-session-answers.edit', compact('quizSessions','questions','choices','quizSessionAns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateQuizSessionAnswerRequest $request, $id)
    {
        $quizSessionAns = QuizSessionAnswer::findOrFail($id);
        $quizSessionAns->fill($request->all());
        $this->authorize('update',$quizSessionAns);
        $quizSessionAns->save();
        $displayUrl = route('web.admin.quiz-session-answers.show', $quizSessionAns->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quizSessionAns->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $quizSessionAns = QuizSessionAnswer::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$quizSessionAns);
        $quizSessionAns->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $quizSessionAns = QuizSessionAnswer::find($id);
        $this->authorize('trash',$quizSessionAns);
        $quizSessionAns->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$quizSessionAns = QuizSession::withTrashed()->where('id', $id)->restore();
        $quizSessionAns = QuizSessionAnswer::withTrashed()->findOrFail($id);
        $this->authorize('restore',$quizSessionAns);
        $quizSessionAns->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
