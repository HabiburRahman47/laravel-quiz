<?php

namespace App\Models\V1\Course;

use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSectionTeacher extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id"];
    public $sortable = ['id', 'updated_at'];
    protected $fillable=[
        'id',
        'course_section_id',
        'teacher_id'
    ];
}
