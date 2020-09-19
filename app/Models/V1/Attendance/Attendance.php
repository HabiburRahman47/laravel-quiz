<?php

namespace App\Model\V1\Attendance;

use App\Model\V1\Course\Course;
use App\Model\V1\Course\CourseSection;
use App\Model\V1\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'info',
        'notes',
        'course_section_id'
    ];
    // public function courseSection(){
    //     return $this->belongsTo(CourseSection::class,'section_id');
    // }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'id');
    }
    public function section(){
        return $this->belongsTo(Course::class,'id');
    }
    public function courseSection(){
        return $this->belongsTo(CourseSection::class);
    }

}
