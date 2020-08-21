<?php

namespace App\Models\V1\Property;

use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyType extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name', 'description',
    ];

    // public function properties()
    // {
    //    return $this->hasMany(Property::class,'type_id');
    // }

    public function properties()
    {
       return $this->hasMany(Property::class,'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by_id');
    }

}
