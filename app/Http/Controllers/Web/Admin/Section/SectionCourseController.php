<?php

namespace App\Http\Controllers\Web\Admin\Section;

use App\DataTables\Section\SectionCourseDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Section\StoreSectionCourseRequest;
use App\Http\Requests\API\V1\Admin\Section\UpdateSectionCourseRequest;
use App\Models\V1\Course\Course;
use App\Models\V1\Course\CourseSection;
use App\Models\V1\Section\Section;
use Illuminate\Http\Request;

class SectionCourseController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SectionCourseDataTable $dataTable)
    {
        $sections = Section::get();
        $courses = Course::get();
        return $dataTable->render('admin.section-courses.index', compact('sections','courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        $courses = Course::where('created_by_id', auth()->user()->id)->get();
        return view('admin.section-courses.create', compact('sections', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionCourseRequest $request)
    {
        $sectionCourse = CourseSection::where('course_id',$request->course_id)->where('section_id',$request->section_id)->first();
        if (!empty($sectionCourse)){
            $this->flashAlreadyCreatedMsg(route('web.admin.section-courses.edit',$sectionCourse->id));
            return redirect()->back()->with(['rID' => $sectionCourse->id]);
        }
        $sectionCourse = new CourseSection();
        $sectionCourse->fill($request->all());
        $sectionCourse->save();

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalName(); // getting image extension
        //     $file->move("uploads/Course-watch-faces/$sectionCourse->id/image/", $extension);
        //     $sectionCourse->image = $extension;
        //     $sectionCourse->save();
        // }


        // $sectionCourse->setMeta('seo', json_encode($request->seo));

        $displayUrl = route('web.admin.section-courses.show', $sectionCourse->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' => $sectionCourse->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sectionCourse = CourseSection::with('section','course')->findOrFail($id);
        return view('admin.section-courses.show', compact('sectionCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        $courses = Course::where('created_by_id', auth()->user()->id)->get();
        $sectionCourse = CourseSection::findOrFail($id);
        // $seo = json_decode($sectionCourse->getMeta('seo'));

        return view('admin.section-courses.edit', compact('courses', 'sections','sectionCourse'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionCourseRequest $request, $id)
    {
        $sectionCourse = CourseSection::findOrFail($id);
        $sectionCourse->fill($request->all());
        $sectionCourse->save();
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalName(); // getting image extension
        //     $file->move("uploads/Course-watch-faces/$sectionCourse->id/image/", $extension);
        //     $sectionCourse->image = $extension;
        //     $sectionCourse->save();
        // }
        // $sectionCourse->setMeta('seo', json_encode($request->seo));

        $displayUrl = route('web.admin.section-courses.show', $sectionCourse->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $sectionCourse->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sectionCourse = CourseSection::withTrashed()->findOrFail($id);
        $sectionCourse->forceDelete();
        return response()->json("success");
    }

    public function trash($id)
    {
        $sectionCourse = CourseSection::find($id);
        $sectionCourse->delete();
        return response()->noContent();
    }

    public function restore($id)
    {
        $sectionCourse = CourseSection::withTrashed()->findOrFail($id);
        $sectionCourse->restore();
        return response()->noContent();
    }
}
