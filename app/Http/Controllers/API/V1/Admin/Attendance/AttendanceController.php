<?php

namespace App\Http\Controllers\API\V1\Admin\Attendance;


use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Attendance\AttendanceRequest;
use App\Http\Requests\API\V1\Admin\Attendance\StoreAttendanceRequest;
use App\Http\Requests\API\V1\Admin\Attendance\UpdateAttendanceRequest;
use App\Http\Resources\API\V1\Admin\Attendance\AttendanceCollection;
use App\Http\Resources\API\V1\Admin\Attendance\AttendanceResource;
use App\Models\V1\Attendance\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends AdminAPIBaseController
{


    public function index(Request $request)
    {
        $attendances=Attendance::applyTrashFilterAble()
            ->applyKeywordSearchAble()
            ->applySortAble()
            ->applyPaginateAble();
        return new AttendanceCollection($attendances);
    }


    public function store(StoreAttendanceRequest $request)
    {
        // $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;

        $attendance=new Attendance();
        $attendance->fill($request->all());
        $attendance->teacher_id=$created_by_id;
        $attendance->save();
        return new AttendanceResource($attendance);
    }


    public function show($attendanceId)
    {
        $attendance=Attendance::findOrFail($attendanceId);
        return new AttendanceResource($attendance);
    }


    public function update(UpdateAttendanceRequest $request,$attendanceId)
    {
        $attendance=Attendance::findOrFail($attendanceId);
        $attendance->fill($request->all());
        $this->authorize('update',$attendance);
        $attendance->save();
        return new AttendanceResource($attendance);
    }

    public function trash($attendanceId)
    {
        $attendance=Attendance::findOrFail($attendanceId);
        $this->authorize('trash',$attendance);
        $attendance->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($attendanceId)
    {
        $attendance=Attendance::withTrashed()->findOrFail($attendanceId);
        $this->authorize('restore',$attendance);
        $attendance->restore();
        return new AttendanceResource($attendance);
    }

    public function destroy($attendanceId){
        $attendance=Attendance::withTrashed()->findOrFail($attendanceId);
        $this->authorize('forceDelete',$attendance);
        $attendance->forceDelete();
        return response()->noContent();
    }
    public function showWithCourseSection($attendanceId){
        $attendanceCourseSection=Attendance::with('teacher','courseSection')->findOrFail($attendanceId);
        return new AttendanceResource($attendanceCourseSection);

    }

}
