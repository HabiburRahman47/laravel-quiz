<?php

namespace App\Http\Controllers\API\V1\Site\Section;

use App\Http\Controllers\API\V1\Site\AdminAPIBaseController;
use App\Http\Requests\API\V1\Site\Section\StoreSectionRequest;
use App\Http\Requests\API\V1\Site\Section\UpdateSectionRequest;
use App\Http\Resources\API\V1\Site\Course\CourseResource;
use App\Http\Resources\API\V1\Site\Course\CourseSectionResource;
use App\Http\Resources\API\V1\Site\Section\SectionCollection;
use App\Http\Resources\API\V1\Site\Section\SectionResource;
use App\Models\V1\Course\Course;
use App\Models\V1\Section\Section;
use Illuminate\Http\Request;

class SectionController extends AdminAPIBaseController
{


    public function index(Request $request)
    {
        $sections = Section::applyTrashFilterAble()
                ->applyKeywordSearchAble()
                ->applySortAble()
                ->applyPaginateAble();
        return new SectionCollection($sections);
    }



    public function store(StoreSectionRequest $request)
    {
        // $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        //Create a Section data
        $section = new Section();
        $section->fill($request->all());
        $section->created_by_id = $created_by_id;
        $section->save();
        return new SectionResource($section);
    }


    public function show($sectionId)
    {
        $section = Section::with('department')->findOrFail($sectionId);
        return new SectionResource($section);
    }


    public function update(UpdateSectionRequest $request, $sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $section->fill($request->all());
        $this->authorize('update',$section);
        $section->save();
        return new SectionResource($section);
    }

    public function trash($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $this->authorize('trash',$section);
        $section->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($sectionId)
    {
        $section = Section::withTrashed()->findOrFail($sectionId);
        $this->authorize('restore',$section);
        $section->restore();
        return new SectionResource($section);
    }

    // PERMANENT DELETE
    public function destroy($sectionId)
    {
        $section = Section::withTrashed()->findOrFail($sectionId);
        $this->authorize('forceDelete',$section);
        $section->forceDelete();
        return response()->noContent();
    }
    // Pivot table
    public function attachCourseToSection($sectionId, $courseId)
    {

        $section = Section::findOrFail($sectionId);
        $course = Course::findOrFail($courseId);
        $section->courses()->attach($course);
        $sectionWithCourses = Section::with('courses')->findOrFail($sectionId);;

        return new SectionResource($sectionWithCourses);
    }

    public function detachCourseFromSection($sectionId, $courseId)
    {
        $section = Section::findOrFail($sectionId);
        $course = Course::findOrFail($courseId);
        $section->courses()->detach($course);
        return response()->noContent();
    }

    //todo naming
    public function showWithCourseAttendance($sectionId)
    {
        $sectionCourseAttendance = Section::with('courses.attendances')->findOrFail($sectionId);
        return new SectionResource($sectionCourseAttendance);
    }
}
