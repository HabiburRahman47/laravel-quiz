<?php

namespace App\Models\V1\Property;

use App\Models\V1\Calendar\Calendar;
use App\Models\V1\Event\Event;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
         'name', 'private_name', 'description', 'type_id' ,'created_by_id',
    ];

    protected $dates = ['deleted_at'];

    //relations
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class,'type_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'created_by_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps()
                    ->withPivot('permission');
    }

}
