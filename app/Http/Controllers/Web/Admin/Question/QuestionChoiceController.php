<?php

namespace App\Http\Controllers\Web\Admin\Question;

use App\DataTables\Question\QuestionChoiceDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Question\StoreQuestionChoiceRequest;
use App\Http\Requests\API\V1\Admin\Question\UpdateQuestionChoiceRequest;
use App\Models\V1\Choice\Choice;
use App\Models\V1\Choice\ChoiceQuestion;
use App\Models\V1\Question\Question;
use Illuminate\Http\Request;

class QuestionChoiceController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionChoiceDataTable $dataTable)
    {
        $questions = Question::get();
        $choices = Choice::get();
        return $dataTable->render('admin.question-choices.index', compact('questions','choices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::where('created_by_id', auth()->user()->id)->get();
        $choices = Choice::where('created_by_id', auth()->user()->id)->get();
        return view('admin.question-choices.create', compact('questions', 'choices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionChoiceRequest $request)
    {
        $questionChoice = ChoiceQuestion::where('choice_id',$request->choice_id)->where('question_id',$request->question_id)->first();
        if (!empty($questionChoice)){
            $this->flashAlreadyCreatedMsg(route('web.admin.question-choices.edit',$questionChoice->id));
            return redirect()->back()->with(['rID' => $questionChoice->id]);
        }
        $questionChoice = new ChoiceQuestion();
        $questionChoice->fill($request->all());
        $questionChoice->save();

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalName(); // getting image extension
        //     $file->move("uploads/Choice-watch-faces/$questionChoice->id/image/", $extension);
        //     $questionChoice->image = $extension;
        //     $questionChoice->save();
        // }


        // $questionChoice->setMeta('seo', json_encode($request->seo));

        $displayUrl = route('web.admin.question-choices.show', $questionChoice->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' => $questionChoice->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questionChoice = ChoiceQuestion::with('questions','choices')->findOrFail($id);
        return view('admin.question-choices.show', compact('questionChoice'));
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
        $choices = Choice::where('created_by_id', auth()->user()->id)->get();
        $questionChoice = ChoiceQuestion::findOrFail($id);
        // $seo = json_decode($questionChoice->getMeta('seo'));

        return view('admin.question-choices.edit', compact('choices', 'questions','questionChoice'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionChoiceRequest $request, $id)
    {
        $questionChoice = ChoiceQuestion::findOrFail($id);
        $questionChoice->fill($request->all());
        $this->authorize('update',$questionChoice);
        $questionChoice->save();
        // $questionChoice->setMeta('seo', json_encode($request->seo));

        $displayUrl = route('web.admin.question-choices.show', $questionChoice->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $questionChoice->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionChoice = ChoiceQuestion::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$questionChoice);
        $questionChoice->forceDelete();
        return response()->json("success");
    }

    public function trash($id)
    {
        $questionChoice = ChoiceQuestion::find($id);
        $this->authorize('trash',$questionChoice);
        $questionChoice->delete();
        return response()->noContent();
    }

    public function restore($id)
    {
        $questionChoice = ChoiceQuestion::withTrashed()->findOrFail($id);
        $this->authorize('restore',$questionChoice);
        $questionChoice->restore();
        return response()->noContent();
    }
}
