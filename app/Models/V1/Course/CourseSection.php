<?php

namespace App\Models\V1\Course;
use App\Models\V1\Section\Section;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends Model
{

    protected $table='course_section';
     protected $dates=['deleted_at'];
    use SearchAble, SortAble, TrashFilterAble, PaginateAble,SoftDeletes;
     public $searchable = ["id", "course_id","section_id"];
    public $sortable = ['id', 'updated_at', 'section_id'];
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
