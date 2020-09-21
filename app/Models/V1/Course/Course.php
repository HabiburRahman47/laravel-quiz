<?php

namespace App\Models\V1\Course;

use App\Http\Requests\AttendanceRequest;
use App\Models\V1\Attendance\Attendance;
use App\Models\V1\Section\Section;
use App\Models\V1\Property\Property;
use App\Models\V1\User\User;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes,SortAble,SearchAble,TrashFilterAble,PaginateAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'id',
        'name',
        'property_id'
    ];
    public function property(){
        return $this->belongsTo(Property::class,'property_id');
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
