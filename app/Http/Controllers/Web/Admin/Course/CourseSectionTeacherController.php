<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\DataTables\Course\CourseDataTable;
use App\DataTables\Course\CourseSectionTeacherDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Course\StoreCourseRequest;
use App\Http\Requests\API\V1\Admin\Course\UpdateCourseRequest;
use App\Http\Requests\API\V1\Admin\CourseSectionTeacher\StoreCourseSectionTeacherRequest;
use App\Models\V1\Course\CourseSectionTeacher;
use App\Models\V1\Section\Section;

class CourseSectionTeacherController extends AdminBaseController
{

    public function index(CourseSectionTeacherDataTable $dataTable)
    {
        // $sections = Section::get();
        // $courses = CourseSectionTeacher::get();
        return $dataTable->render('admin.course-section-teachers.index');
    }

    public function create()
    {
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        $courseSectionTeachers = CourseSectionTeacher::where('teacher_id', auth()->user()->id)->get();
        return view('admin.course-section-teachers.create', compact('sections', 'courseSectionTeachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return void
     */
    public function store(StoreCourseSectionTeacherRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $courseSectionTeacher = new CourseSectionTeacher();
        $courseSectionTeacher->fill($request->all());
        $courseSectionTeacher->teacher_id=$created_by_id;
        $courseSectionTeacher->save();


        $displayUrl = route('web.admin.course-section-teachers.show', $courseSectionTeacher->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$courseSectionTeacher->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CourseResource
     */
    public function show($id)
    {
        $courseSectionTeacher = CourseSectionTeacher::findOrFail($id);
        // $this->authorize('show',$courseSectionTeacher);
        return view('admin.course-section-teachers.show', compact('courseSectionTeacher'));
    }

    public function edit($id)
    {
        $courseSectionTeacher = CourseSectionTeacher::findOrFail($id);
        return view('admin.course-section-teachers.edit', compact('courseSectionTeacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param int $id
     * @return CourseResource
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $courseSectionTeacher = CourseSectionTeacher::findOrFail($id);
        $courseSectionTeacher->fill($request->all());
        $this->authorize('update',$courseSectionTeacher);
        $courseSectionTeacher->save();
        $displayUrl = route('web.admin.course-section-teachers.show', $courseSectionTeacher->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $courseSectionTeacher->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $courseSectionTeacher = CourseSectionTeacher::withTrashed()->findOrFail($id);
        $this->authorize('destroy',$courseSectionTeacher);
        $courseSectionTeacher->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $courseSectionTeacher = CourseSectionTeacher::find($id);
        $this->authorize('trash',$courseSectionTeacher);
        $courseSectionTeacher->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$courseSectionTeacher = CourseSectionTeacher::withTrashed()->where('id', $id)->restore();
        $courseSectionTeacher = CourseSectionTeacher::withTrashed()->findOrFail($id);
        $this->authorize('restore',$courseSectionTeacher);
        $courseSectionTeacher->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
