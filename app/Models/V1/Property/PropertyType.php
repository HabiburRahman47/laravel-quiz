<?php

namespace App\Models\V1\Property;

use App\Models\V1\User\User;


use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PropertyType extends Model
{
    use SearchAble, SortAble, TrashFilterAble, PaginateAble, SoftDeletes,HasSlug;

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are simply searchable using query as &search_keyword=keyword.
     *
     * @var array
     */
    public $searchable = ["id", "name"];

    /**
     * The attributes that are sortable using query as &sort_by=attributeName&sort_direction=direction (i.e. asc/desc).
     *
     * @var array
     */
    public $sortable = ['id', 'updated_at', 'name'];

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


    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getSuggestedAttribute($value)
    {
        return (boolean)$value;
    }
}
