<?php

namespace App\Model\V1\Department;

use App\Model\V1\Institution\Institution;
use App\Model\V1\Section\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $table='departmets';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'name',
        'institution_id',
        'created_by_id'
    ];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class,'department_id');
    }

}
