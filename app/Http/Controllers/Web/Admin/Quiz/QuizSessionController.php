<?php

namespace App\Http\Controllers\Web\Admin\Quiz;

use App\DataTables\Quiz\QuizSessionDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizResultRequest;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizSessionRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizResultRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizSessionRequest;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizSession;

class QuizSessionController extends AdminBaseController
{

    public function index(QuizSessionDataTable $dataTable)
    {
        return $dataTable->render('admin.quiz-sessions.index');
    }

    public function create()
    {
        $quizzes = Quiz::where('created_by_id', auth()->user()->id)->get();
        return view('admin.quiz-sessions.create', compact('quizzes'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreQuizSessionRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $quizSession = new QuizSession();
        $quizSession->fill($request->all());
        $quizSession->created_by_id=$created_by_id;
        $quizSession->save();


        $displayUrl = route('web.admin.quiz-sessions.show', $quizSession->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$quizSession->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $quizSession = QuizSession::findOrFail($id);
        // $this->authorize('show',$quizSession);
        return view('admin.quiz-sessions.show', compact('quizSession'));
    }

    public function edit($id)
    {
        $quizzes = Quiz::where('created_by_id', auth()->user()->id)->get();
        $quizSession = QuizSession::findOrFail($id);
        return view('admin.quiz-sessions.edit', compact('quizzes','quizSession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateQuizSessionRequest $request, $id)
    {
        $quizSession = QuizSession::findOrFail($id);
        $quizSession->fill($request->all());
        $this->authorize('update',$quizSession);
        $quizSession->save();
        $displayUrl = route('web.admin.quiz-sessions.show', $quizSession->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quizSession->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $quizSession = QuizSession::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$quizSession);
        $quizSession->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $quizSession = QuizSession::find($id);
        $this->authorize('trash',$quizSession);
        $quizSession->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$quizSession = QuizSession::withTrashed()->where('id', $id)->restore();
        $quizSession = QuizSession::withTrashed()->findOrFail($id);
        $this->authorize('restore',$quizSession);
        $quizSession->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
