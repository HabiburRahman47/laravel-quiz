<?php

namespace App\Http\Controllers\Web\Admin\Quiz;

use App\DataTables\Quiz\QuizResultDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizResultRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizResultRequest;
use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;

class QuizResultController extends AdminBaseController
{

    public function index(QuizResultDataTable $dataTable)
    {
        return $dataTable->render('admin.quiz-results.index');
    }

    public function create()
    {
        $quizSessions = QuizSession::where('created_by_id', auth()->user()->id)->get();
        return view('admin.quiz-results.create', compact('quizSessions'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreQuizResultRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $quizResult = new QuizResult();
        $quizResult->fill($request->all());
        $quizResult->created_by_id=$created_by_id;
        $quizResult->save();


        $displayUrl = route('web.admin.quiz-results.show', $quizResult->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$quizResult->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $quizResult = QuizResult::findOrFail($id);
        // $this->authorize('show',$quizResult);
        return view('admin.quiz-results.show', compact('quizResult'));
    }

    public function edit($id)
    {
        $quizSessions = QuizSession::where('created_by_id', auth()->user()->id)->get();
        $quizResult = QuizResult::findOrFail($id);
        return view('admin.quiz-results.edit', compact('quizResult','quizSessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateQuizResultRequest $request, $id)
    {
        $quizResult = QuizResult::findOrFail($id);
        $quizResult->fill($request->all());
        $this->authorize('update',$quizResult);
        $quizResult->save();
        $displayUrl = route('web.admin.quiz-results.show', $quizResult->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quizResult->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $quizResult = QuizResult::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$quizResult);
        $quizResult->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $quizResult = QuizResult::find($id);
        $this->authorize('trash',$quizResult);
        $quizResult->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$quizResult = QuizResult::withTrashed()->where('id', $id)->restore();
        $quizResult = QuizResult::withTrashed()->findOrFail($id);
        $this->authorize('restore',$quizResult);
        $quizResult->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
