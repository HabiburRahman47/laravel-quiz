<?php

namespace App\Http\Controllers\Web\Admin\Section;

use App\DataTables\Section\SectionDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Section\StoreSectionRequest;
use App\Http\Requests\API\V1\Admin\Section\UpdateSectionRequest;
use App\Models\V1\Department\Department;
use App\Models\V1\Section\Section;

class SectionController extends AdminBaseController
{

    public function index(SectionDataTable $dataTable)
    {
        return $dataTable->render('admin.sections.index');
    }

    public function create()
    {
        $departments = Department::where('created_by_id', auth()->user()->id)->get();
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        return view('admin.sections.create', compact('departments','sections'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreSectionRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $section = new Section();
        $section->fill($request->all());
        $section->created_by_id = $created_by_id;
        $section->save();


        $displayUrl = route('web.admin.sections.show', $section->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$section->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        // $this->authorize('show',$section);
        return view('admin.sections.show', compact('section'));
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateSectionRequest $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->fill($request->all());
        $this->authorize('update',$section);
        $section->save();
        $displayUrl = route('web.admin.sections.show', $section->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $section->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $section = Section::withTrashed()->findOrFail($id);
        $this->authorize('destroy',$section);
        $section->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $section = Section::find($id);
        $this->authorize('trash',$section);
        $section->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$section = Section::withTrashed()->where('id', $id)->restore();
        $section = Section::withTrashed()->findOrFail($id);
        $this->authorize('restore',$section);
        $section->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
