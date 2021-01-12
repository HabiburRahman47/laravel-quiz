<?php

namespace App\Models\V1\Department;

use App\Models\V1\Property\Property;
use App\Models\V1\Section\Section;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $table='departments';
    protected $dates=['deleted_at'];
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'name',
        'property_id',
        'created_by_id'
    ];
    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class,'department_id');
    }

}
