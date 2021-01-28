<?php

namespace App\Models\V1\Quiz;

use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class QuizSession extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble,HasSlug;
    protected $table='quiz_sessions';
    protected $dates=['deleted_at'];
    public $searchable = ["id", "quiz_name"];
    public $sortable = ['id', 'updated_at', 'quiz_name'];
    protected $fillable=[
        'quiz_name',
        'quiz_id',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('quiz_name')
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

    public function result(){
        return $this->hasOne(QuizResult::class,'session_id');
    }
    public function quiz(){
       return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function question(){
        return $this->belongsTo(Question::class,'question_id');
    }
    public function getStatusAttribute($value)
    {
        return (boolean)$value;
    }

}
