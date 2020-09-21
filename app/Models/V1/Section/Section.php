<?php

namespace App\Models\V1\Section;

use App\Models\V1\Course\Course;
use App\Models\V1\Department\Department;
use App\Models\V1\Student\Student;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes,SearchAble,TrashFilterAble,PaginateAble,SortAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'name',
        'department_id',
        'created_by_id'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
