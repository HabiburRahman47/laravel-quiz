<?php

namespace App\Models\V1\Attendance;

use App\Models\V1\Course\Course;
use App\Models\V1\Course\CourseSection;
use App\Models\V1\User\User;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes,SearchAble,SortAble,TrashFilterAble,PaginateAble;
    protected $dates=['deleted_at'];

    public $searchable = ["id"];
    public $sortable = ['id', 'updated_at'];

    protected $fillable=[
        'id',
        'info',
        'notes',
        'course_section_id'
    ];

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



