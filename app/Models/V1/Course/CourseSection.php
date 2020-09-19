<?php

namespace App\Model\V1\Course;
use App\Model\V1\Section\Section;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{

    protected $table='course_section';
    protected $fillable=[
        'course_id',
        'section_id'
    ];
    public function attendences(){
        return $this->hasMany(Attendance::class);
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }


}
