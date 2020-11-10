<?php

namespace App\Http\Controllers\Web\Admin\Choice;

use App\DataTables\Choice\ChoiceDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Choice\StoreChoiceRequest;
use App\Http\Requests\API\V1\Admin\Choice\UpdateChoiceRequest;
use App\Models\V1\Choice\Choice;

class ChoiceController extends AdminBaseController
{

    public function index(ChoiceDataTable $dataTable)
    {
        return $dataTable->render('admin.choices.index');
    }

    public function create()
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        return view('admin.choices.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreChoiceRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $choice = new Choice();
        $choice->fill($request->all());
        $choice->created_by_id = $created_by_id;
        $choice->save();


        $displayUrl = route('web.admin.choices.show', $choice->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$choice->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $choice = Choice::findOrFail($id);
        // $this->authorize('show',$choice);
        return view('admin.choices.show', compact('choice'));
    }

    public function edit($id)
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $choice = Choice::findOrFail($id);
        return view('admin.choices.edit', compact('choice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateChoiceRequest $request, $id)
    {
        $choice = Choice::findOrFail($id);
        $choice->fill($request->all());
        $this->authorize('update',$choice);
        $choice->save();
        $displayUrl = route('web.admin.choices.show', $choice->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $choice->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $choice = Choice::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$choice);
        $choice->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $choice = Choice::find($id);
        $this->authorize('trash',$choice);
        $choice->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$choice = Choice::withTrashed()->where('id', $id)->restore();
        $choice = Choice::withTrashed()->findOrFail($id);
        $this->authorize('restore',$choice);
        $choice->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
