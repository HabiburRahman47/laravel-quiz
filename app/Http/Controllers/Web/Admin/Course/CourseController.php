<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\DataTables\Course\CourseDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Course\StoreCourseRequest;
use App\Http\Requests\API\V1\Admin\Course\UpdateCourseRequest;
use App\Models\V1\Course\Course;
use App\Models\V1\Property\Property;

class CourseController extends AdminBaseController
{

    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.courses.index');
    }

    public function create()
    {
        $properties = Property::where('created_by_id', auth()->user()->id)->get();
        $courses = Course::where('created_by_id', auth()->user()->id)->get();
        return view('admin.courses.create', compact('courses','properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return void
     */
    public function store(StoreCourseRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $course = new Course();
        $course->fill($request->all());
        $course->created_by_id=$created_by_id;
        $course->save();


        $displayUrl = route('web.admin.courses.show', $course->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$course->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CourseResource
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        // $this->authorize('show',$course);
        return view('admin.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $properties=Property::where('created_by_id', auth()->user()->id)->get();
        return view('admin.courses.edit', compact('course','properties'));
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
        $course = Course::findOrFail($id);
        $course->fill($request->all());
        $this->authorize('update',$course);
        $course->save();
        $displayUrl = route('web.admin.courses.show', $course->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$course);
        $course->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $course = Course::find($id);
        $this->authorize('trash',$course);
        $course->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$course = Course::withTrashed()->where('id', $id)->restore();
        $course = Course::withTrashed()->findOrFail($id);
        $this->authorize('restore',$course);
        $course->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
