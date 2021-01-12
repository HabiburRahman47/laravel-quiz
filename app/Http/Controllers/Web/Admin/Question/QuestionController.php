<?php

namespace App\Http\Controllers\Web\Admin\Question;

use App\DataTables\Question\QuestionDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Question\StoreQuestionRequest;
use App\Http\Requests\API\V1\Admin\Question\UpdateQuestionRequest;
use App\Models\V1\Question\Question;
use Spatie\Tags\Tag;

class QuestionController extends AdminBaseController
{

    public function index(QuestionDataTable $dataTable)
    {
        return $dataTable->render('admin.questions.index');
    }

    public function create()
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $tags=Tag::get();
        return view('admin.questions.create',compact('tags'));        
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
        $question->attachTags($request->tags);


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
        $tags=Tag::get();
        $question = Question::with('tags')->findOrFail($id);
        $tagNames=$question->tags->pluck('name');
        // return response(gettype($tagNames));

        return view('admin.questions.show', compact('question','tagNames'));
    }

    public function edit($id)
    {
        $tags=Tag::get();
        $question = Question::with('tags')->findOrFail($id);
        $tagName=$question->tags->pluck('name');
        // return response($tagName);
        return view('admin.questions.edit', compact('question','tags','tagName'));
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
        $question->attachTags($request->tags);

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
        $this->authorize('forceDelete',$question);
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
