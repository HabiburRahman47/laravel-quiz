<?php

namespace App\Http\Controllers\Web\Admin\Department;

use App\DataTables\Department\DepartmentDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\API\V1\Admin\Department\UpdateDepartmentRequest;
use App\Models\V1\Department\Department;
use App\Models\V1\Property\Property;

class DepartmentController extends AdminBaseController
{

    public function index(DepartmentDataTable $dataTable)
    {
        return $dataTable->render('admin.departments.index');
    }

    public function create()
    {
        $properties = Property::where('created_by_id', auth()->user()->id)->get();
        $departments = Department::where('created_by_id', auth()->user()->id)->get();
        return view('admin.departments.create', compact('departments','properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentRequest $request
     * @return void
     */
    public function store(StoreDepartmentRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $department = new Department();
        $department->fill($request->all());
        $department->created_by_id = $created_by_id;
        $department->save();


        $displayUrl = route('web.admin.departments.show', $department->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$department->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DepartmentResource
     */
    public function show($id)
    {
        $department = Department::findOrFail($id);
        // $this->authorize('show',$department);
        return view('admin.departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentRequest $request
     * @param int $id
     * @return DepartmentResource
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->fill($request->all());
        $this->authorize('update',$department);
        $department->save();
        $displayUrl = route('web.admin.departments.show', $department->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $department->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $this->authorize('destroy',$department);
        $department->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $department = Department::find($id);
        $this->authorize('trash',$department);
        $department->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$department = Department::withTrashed()->where('id', $id)->restore();
        $department = Department::withTrashed()->findOrFail($id);
        $this->authorize('restore',$department);
        $department->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
