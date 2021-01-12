<?php

namespace App\Models\V1\Tag;

use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Tag extends Model
{
    // use SortAble,SearchAble,PaginateAble,TrashFilterAble;
    use SearchAble,SortAble,PaginateAble,TrashFilterAble,HasTags;
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'name',
        'slug'
    ];
    // public function questions()
    // {
    //   return $this->belongsToMany(Question::class);
    // }
}
