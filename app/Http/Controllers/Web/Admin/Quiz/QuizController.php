<?php

namespace App\Http\Controllers\Web\Admin\Quiz;

use App\DataTables\Quiz\QuizDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Quiz\StoreQuizRequest;
use App\Http\Requests\API\V1\Admin\Quiz\UpdateQuizRequest;
use App\Models\V1\Category\Category;
use App\Models\V1\Quiz\Quiz;

class QuizController extends AdminBaseController
{

    public function index(QuizDataTable $dataTable)
    {
        return $dataTable->render('admin.quizzes.index');
    }

    public function create()
    {
        $categories = Category::where('created_by_id', auth()->user()->id)->get();
        return view('admin.quizzes.create', compact('categories'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreQuizRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $quiz = new Quiz();
        $quiz->fill($request->all());
        $quiz->created_by_id = $created_by_id;
        $quiz->save();


        $displayUrl = route('web.admin.quizzes.show', $quiz->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$quiz->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        // $this->authorize('show',$quiz);
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit($id)
    {
        $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $quiz = Quiz::findOrFail($id);
        return view('admin.quizzes.edit', compact('quiz','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateQuizRequest $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->fill($request->all());
        $this->authorize('update',$quiz);
        $quiz->save();
        $displayUrl = route('web.admin.quizzes.show', $quiz->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $quiz->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $quiz = Quiz::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$quiz);
        $quiz->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $quiz = Quiz::find($id);
        $this->authorize('trash',$quiz);
        $quiz->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$quiz = Quiz::withTrashed()->where('id', $id)->restore();
        $quiz = Quiz::withTrashed()->findOrFail($id);
        $this->authorize('restore',$quiz);
        $quiz->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
