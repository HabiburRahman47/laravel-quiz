<?php

namespace App\Models\V1\Category;

use App\Models\V1\Quiz\Quiz;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use SoftDeletes,SortAble,PaginateAble,TrashFilterAble,SearchAble,HasSlug;
    protected $dates=['deleted_at'];

    public $searchable = ["id","name"];
    public $sortable = ['id', 'updated_at','name'];
    public $fillable =[
        'name',
        'parent_id'
   ];

   /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function childs(){

        return $this->hasMany(Category::class, 'parent_id','id');
    }
    public function quizzes(){
        return $this->hasMany(Quiz::class,'category_id');
    }


}
