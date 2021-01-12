<?php

namespace App\Models\V1\Quiz;

use App\Models\V1\Category\Category;
use App\Models\V1\Choice\ChoiceQuestion;
use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    protected $dates=['deleted_at'];
    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];
    protected $fillable=[
        'name',
        'description',
        'config',
        'category_id'
    ];
    public function questions()
    {
       return $this->belongsToMany(Question::class);
    }
    public function choiceQuestion(){
        return $this->belongsTo(ChoiceQuestion::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


}



