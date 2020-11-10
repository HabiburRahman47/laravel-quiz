<?php

namespace App\Http\Controllers\API\V1\Site\Department;

use App\Http\Controllers\API\V1\Site\AdminAPIBaseController;
use App\Http\Requests\API\V1\Site\Department\StoreDepartmentRequest;
use App\Http\Requests\API\V1\Site\Department\UpdateDepartmentRequest;
use App\Http\Resources\API\V1\Site\Department\DepartmentCollection;
use App\Http\Resources\API\V1\Site\Department\DepartmentResource;
use App\Models\V1\Department\Department;
use Illuminate\Http\Request;

class DepartmentController extends AdminAPIBaseController
{


    public function index()
    {
        $departments=Department::applyTrashFilterAble()
                ->applyKeywordSearchAble()
                ->applySortAble()
                ->applyPaginateAble();
        return new DepartmentCollection($departments);
    }


    public function store(StoreDepartmentRequest $request)
    {
        // $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        //Create a department data
        $department=new Department();
        $department->fill($request->all());
        $department->created_by_id=$created_by_id;
        $department->save();
        return new DepartmentResource($department);
    }


    public function show($departmentId)
    {
        $department=Department::with('sections')->findOrFail($departmentId);
        return new DepartmentResource($department);
    }


    public function update(UpdateDepartmentRequest $request,$departmentId)
    {
        $department=Department::findOrFail($departmentId);
        $department->fill($request->all());
        $this->authorize('update',$department);
        $department->save();
        return new DepartmentResource($department);
    }

    public function trash($departmentId)
    {
        $department=Department::findOrFail($departmentId);
        $this->authorize('trash',$department);
        $department->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($departmentId)
    {
        $department=Department::withTrashed()->findOrFail($departmentId);
        $this->authorize('restore',$department);
        $department->restore();
        return new DepartmentResource($department);
    }

    //PERMANENT DELETE
    public function destroy($departmentId)
    {
        $department=Department::withTrashed()->findOrFail($departmentId);
        $this->authorize('forceDelete',$department);
        $department->forceDelete();
        return response()->noContent();
    }

}
