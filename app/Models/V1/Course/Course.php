<?php

namespace App\Model\V1\Course;

use App\Http\Requests\AttendanceRequest;
use App\Model\V1\Attendance\Attendance;
use App\Model\V1\Section\Section;
use App\Model\V1\Institution\Institution;
use App\Model\V1\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'name',
        'institution_id'
    ];
    public function institution(){
        return $this->belongsTo(Institution::class,'institution_id');
    }
    public function sections(){
        return $this->belongsToMany(Section::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class,'course_section_id');
    }
    public function courseSection(){
        return $this->belongsToMany(CourseSection::class,'course_id');
    }
    public function teacher(){
        return $this->belongsTo(User::class);
    }

}
