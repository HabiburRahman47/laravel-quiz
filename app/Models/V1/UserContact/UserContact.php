<?php

namespace App\Models\V1\UserContact;

use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContact extends Model
{
      use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
      protected $dates=['deleted_at'];
      protected $table ='user_contacts';

      public $searchable = ["id", "name"];
      public $sortable = ['id', 'updated_at', 'name'];

      protected $fillable = [
        'name',
        'email',
        'description',
        'visibility',
    ];
}













