<?php

namespace App\Http\Controllers\Web\Admin\Attendance;

use App\DataTables\Attendance\AttendanceDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Attendance\StoreAttendanceRequest;
use App\Http\Requests\API\V1\Admin\Attendance\UpdateAttendanceRequest;
use App\Http\Requests\API\V1\Admin\Section\StoreSectionRequest;
use App\Http\Requests\API\V1\Admin\Section\UpdateSectionRequest;
use App\Models\V1\Attendance\Attendance;
use App\Models\V1\Course\CourseSection;

class AttendanceController extends AdminBaseController
{

    public function index(AttendanceDataTable $dataTable)
    {
        return $dataTable->render('admin.attendances.index');
    }

    public function create()
    {
       
        $courseSections = CourseSection::where('created_by_id', auth()->user()->id)->get();
        return view('admin.attendances.create', compact('courseSections'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreAttendanceRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $attendance = new Attendance();
        $attendance->fill($request->all());
        $attendance->teacher_id = $created_by_id;
        $attendance->save();


        $displayUrl = route('web.admin.attendances.show', $attendance->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$attendance->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendances.show', compact('attendance'));
    }

    public function edit($id)
    {
        $courseSections = CourseSection::all();
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendances.edit', compact('attendance','courseSections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateAttendanceRequest $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->fill($request->all());
        $this->authorize('update',$attendance);
        $attendance->save();
        $displayUrl = route('web.admin.attendances.show', $attendance->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $attendance->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $attendance = Attendance::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$attendance);
        $attendance->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $attendance = Attendance::find($id);
        $this->authorize('trash',$attendance);
        $attendance->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$attendance = Attendance::withTrashed()->where('id', $id)->restore();
        $attendance = Attendance::withTrashed()->findOrFail($id);
        $this->authorize('restore',$attendance);
        $attendance->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
