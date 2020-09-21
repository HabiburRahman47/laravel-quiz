<?php

namespace App\Http\Controllers\API\V1\Admin\Student;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Student\StoreStudentRequest;
use App\Http\Requests\API\V1\Admin\Student\StudentRequest;
use App\Http\Requests\API\V1\Admin\Student\UpdateStudentRequest;
use App\Http\Resources\API\V1\Admin\Student\StudentCollection;
use App\Http\Resources\API\V1\Admin\Student\StudentResource;
use App\Models\V1\Student\Student;
use Illuminate\Http\Response;

class StudentController extends AdminAPIBaseController
{


    public function index(Response $request)
    {
        $students=Student::applyTrashFilterAble()
                ->applyKeywordSearchAble()
                ->applySortAble()
                ->applyPaginateAble();
        return new StudentCollection($students);
    }


    public function store(StoreStudentRequest $request)
    {
        $created_by_id = auth()->user()->id;
        //Create a Section data
        $student=new Student();
        $student->fill($request->all());
        $student->user_id=$created_by_id;
        $student->save();
        return new StudentResource($student);
    }


    public function show($studentId)
    {
        $student=Student::findOrFail($studentId);
        return new StudentResource($student);
    }


    public function update(UpdateStudentRequest $request,$studentId)
    {
        $student=Student::findOrFail($studentId);
        $student->fill($request->all());
        $this->authorize('update',$student);
        $student->save();
        return new StudentResource($student);
    }


    public function trash($studentId)
    {
        $student=Student::findOrFail($studentId);
        $this->authorize('trash',$student);
        $student->delete();

        return response()->noContent();
    }

    //restore data
    public function restore($studentId)
    {
        $student=Student::withTrashed()->findOrFail($studentId);
        $this->authorize('restore',$student);
        $student->restore();
        return new StudentResource($student);
    }

    public function destroy($studentId){
        $student=Student::withTrashed()->findOrFail($studentId);
        $this->authorize('forceDelete',$student);
        $student->forceDelete();
        return response()->noContent();
    }



}
