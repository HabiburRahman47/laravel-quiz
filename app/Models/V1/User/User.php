<?php

namespace App\Models\V1\User;

use App\Models\V1\Event\Event;
use App\Models\V1\Event\EventType;
use App\Models\V1\Friendship\FriendshipGroup;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;
use App\Models\V1\Topic\Topic;
use App\Models\V1\Topic\TopicType;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Rezwanul7\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SortAble,SearchAble,TrashFilterAble,PaginateAble;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //property
    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class,'created_by_id');
    }

    public function properties()
    {
       return $this->hasMany(Property::class,'created_by_id');
    }
}
