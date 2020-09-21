<?php

namespace App\Models\V1\Choice;

use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes,SortAble,SearchAble,TrashFilterAble,PaginateAble;
    protected $dates=['deleted_at'];

    public $searchable = ["id", "name"];
    public $sortable = ['id', 'updated_at', 'name'];

    protected $fillable=[
        'name',
        'image'
    ];
    public function question(){
        return $this->belongsTo(Question::class,'question_id');
    }
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
