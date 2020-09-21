<?php

namespace App\Http\Controllers\API\V1\Admin\Course;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Card\CourseSectionTeacherRequest;
use App\Http\Requests\API\V1\Admin\CourseSectionTeacher\StoreCourseSectionTeacherRequest;
use App\Http\Requests\API\V1\Admin\CourseSectionTeacher\UpdateCourseSectionTeacherRequest;
use App\Http\Resources\API\V1\Admin\Course\CourseSectionTeacherCollection;
use App\Http\Resources\API\V1\Admin\Course\CourseSectionTeacherResource;
use App\Models\V1\Course\CourseSectionTeacher;
use Illuminate\Http\Request;

class CourseSectionTeacherController extends AdminAPIBaseController
{

    public function index(Request $request)
    {
        $courseSectionTeachers=CourseSectionTeacher::applyTrashFilterAble()
                ->applyKeywordSearchAble()
                ->applySortAble()
                ->applyPaginateAble();
        return new CourseSectionTeacherCollection($courseSectionTeachers);
    }


    public function store(StoreCourseSectionTeacherRequest $request)
     {
    //     $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;

        $courseSectionTeacher=new CourseSectionTeacher();
        $courseSectionTeacher->fill($request->all());
        $courseSectionTeacher->teacher_id=$created_by_id;
        $courseSectionTeacher->save();
        return new CourseSectionTeacherResource($courseSectionTeacher);
    }


    public function show($courseSectionTeacherId)
    {
        $courseSectionTeacher=CourseSectionTeacher::findOrFail($courseSectionTeacherId);
        return new CourseSectionTeacherResource($courseSectionTeacher);
    }


    public function update(UpdateCourseSectionTeacherRequest $request,$courseSectionTeacherId)
    {
        $courseSectionTeacher=CourseSectionTeacher::findOrFail($courseSectionTeacherId);
        $courseSectionTeacher->fill($request->all());
        $this->authorize('update',$courseSectionTeacher);
        $courseSectionTeacher->save();
        return new CourseSectionTeacherResource($courseSectionTeacher);
    }

    public function trash($courseSectionTeacherId)
    {
        $courseSectionTeacher=CourseSectionTeacher::findOrFail($courseSectionTeacherId);
        $this->authorize('trash',$courseSectionTeacher);
        $courseSectionTeacher->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($courseSectionTeacherId)
    {
        $courseSectionTeacher=CourseSectionTeacher::withTrashed()->findOrFail($courseSectionTeacherId);
        $this->authorize('restore',$courseSectionTeacher);
        $courseSectionTeacher->restore();
        return new CourseSectionTeacherResource($courseSectionTeacher);
    }

    public function destroy($courseSectionTeacherId){
        $courseSectionTeacher=CourseSectionTeacher::onlyTrashed()->findOrFail($courseSectionTeacherId);
        $this->authorize('forceDelete',$courseSectionTeacher);
        $courseSectionTeacher->forceDelete();
        return response()->noContent();
    }

}
