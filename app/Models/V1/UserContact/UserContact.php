<?php

namespace App\Model\V1\UserContact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContact extends Model
{
      use SoftDeletes;
      protected $dates=['deleted_at'];
      protected $table ='user_contacts';
      protected $fillable = [
        'name',
        'phone_email',
        'description',
        'visibility',
    ];
    // protected $guarded=[
    //   'description'
    // ];
}
