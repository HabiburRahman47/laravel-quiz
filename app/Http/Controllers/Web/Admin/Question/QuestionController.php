<?php

namespace App\Http\Controllers\Web\Admin\Question;

use App\DataTables\Question\QuestionDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Question\StoreQuestionRequest;
use App\Http\Requests\API\V1\Admin\Question\UpdateQuestionRequest;
use App\Models\V1\Question\Question;

class QuestionController extends AdminBaseController
{

    public function index(QuestionDataTable $dataTable)
    {
        return $dataTable->render('admin.questions.index');
    }

    public function create()
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        return view('admin.questions.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreQuestionRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $question = new Question();
        $question->fill($request->all());
        $question->created_by_id = $created_by_id;
        $question->save();


        $displayUrl = route('web.admin.questions.show', $question->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$question->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        // $this->authorize('show',$question);
        return view('admin.questions.show', compact('question'));
    }

    public function edit($id)
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $question = Question::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->fill($request->all());
        $this->authorize('update',$question);
        $question->save();
        $displayUrl = route('web.admin.questions.show', $question->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $question = Question::withTrashed()->findOrFail($id);
        $this->authorize('destroy',$question);
        $question->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $question = Question::find($id);
        $this->authorize('trash',$question);
        $question->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$question = Question::withTrashed()->where('id', $id)->restore();
        $question = Question::withTrashed()->findOrFail($id);
        $this->authorize('restore',$question);
        $question->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
