<?php

namespace App\Http\Controllers\API\V1\Site\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Site\Course\CourseRequest;
use App\Http\Requests\API\V1\Site\Course\StoreCourseRequest;
use App\Http\Requests\API\V1\Site\Course\UpdateCourseRequest;
use App\Http\Resources\API\V1\Site\Course\CourseCollection;
use App\Http\Resources\API\V1\Site\Course\CourseResource;
use App\Models\V1\Course\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses=Course::applyTrashFilterAble()
            ->applyKeywordSearchAble()
            ->applySortAble()
            ->applyPaginateAble();
        return new CourseCollection($courses);
    }


    public function store(StoreCourseRequest $request)
    {
        $course=new Course();
        $course->fill($request->all());
        $course->save();
        return new CourseResource($course);
    }


    public function show($courseId)
    {
        $course=Course::with('attendances')->findOrFail($courseId);
        return new CourseResource($course);
    }


    public function update(UpdateCourseRequest $request,$courseId)
    {
        $course=Course::findOrFail($courseId);
        $course->fill($request->all());
        $course->save();
        return new CourseResource($course);
    }

    public function trash($courseId)
    {
        $course=Course::findOrFail($courseId);
        $course->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($courseId)
    {
        $course=Course::withTrashed()->findOrFail($courseId);
        $course->restore();
        return new CourseResource($course);
    }

    public function destroy($courseId){
        $course=Course::withTrashed()->findOrFail($courseId);
        $course->forceDelete();
        return response()->noContent();
    }

}
