<?php

namespace App\Model\V1\Section;

use App\Model\V1\Course\Course;
use App\Model\V1\Department\Department;
use App\Model\V1\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
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
