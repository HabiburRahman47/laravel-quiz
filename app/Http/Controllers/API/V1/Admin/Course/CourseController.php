<?php

namespace App\Http\Controllers\API\V1\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\Course\CourseRequest;
use App\Http\Requests\API\V1\Admin\Course\StoreCourseRequest;
use App\Http\Requests\API\V1\Admin\Course\UpdateCourseRequest;
use App\Http\Resources\API\V1\Admin\Course\CourseCollection;
use App\Http\Resources\API\V1\Admin\Course\CourseResource;
use App\Model\V1\Course\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses=Course::all();
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
        $course=Course::withTrashed()->where('id',$courseId)->restore();
        return new CourseResource($course);
    }

    public function destroy($courseId){
        $course=Course::onlyTrashed()->where('id',$courseId);
        $course->forceDelete();
        return response()->noContent();
    }

}
