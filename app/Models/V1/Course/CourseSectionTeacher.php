<?php

namespace App\Model\V1\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSectionTeacher extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'course_section_id',
        'teacher_id'
    ];
}
