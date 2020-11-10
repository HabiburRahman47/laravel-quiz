<?php

namespace App\Models\V1\Property;

use App\Models\V1\Department\Department;
use App\Models\V1\User\User;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Property extends Model
{
    use SearchAble, SortAble, TrashFilterAble, PaginateAble, SoftDeletes;

    protected $fillable = [
         'name', 'private_name', 'description', 'property_type_id' ,'created_by_id',
    ];

    protected $dates = ['deleted_at'];

    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];

    //relations
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class,'property_type_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'created_by_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class,'property_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class,'property_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps()
                    ->withPivot('permission');
    }

}
