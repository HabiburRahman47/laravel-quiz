<?php

namespace App\Http\Controllers\Web\Admin\Student;


use App\DataTables\Student\StudentDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Section\StoreSectionRequest;
use App\Http\Requests\API\V1\Admin\Section\UpdateSectionRequest;
use App\Http\Requests\API\V1\Admin\Student\StoreStudentRequest;
use App\Http\Requests\API\V1\Admin\Student\UpdateStudentRequest;
use App\Models\V1\Property\Property;
use App\Models\V1\Section\Section;
use App\Models\V1\Student\Student;

class StudentController extends AdminBaseController
{

    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('admin.students.index');
    }

    public function create()
    {
        $propertries = Property::where('created_by_id', auth()->user()->id)->get();
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        return view('admin.students.create', compact('propertries','sections'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreStudentRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $student = new Student();
        $student->fill($request->all());
        $student->user_id = $created_by_id;
        $student->save();


        $displayUrl = route('web.admin.students.show', $student->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$student->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        // $this->authorize('show',$student);
        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        $properties = Property::where('created_by_id', auth()->user()->id)->get();
        $sections = Section::where('created_by_id', auth()->user()->id)->get();
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student','properties','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->fill($request->all());
        $this->authorize('update',$student);
        $student->save();
        $displayUrl = route('web.admin.students.show', $student->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $student->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $this->authorize('destroy',$student);
        $student->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $student = Student::find($id);
        $this->authorize('trash',$student);
        $student->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$student = Student::withTrashed()->where('id', $id)->restore();
        $student = Student::withTrashed()->findOrFail($id);
        $this->authorize('restore',$student);
        $student->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
