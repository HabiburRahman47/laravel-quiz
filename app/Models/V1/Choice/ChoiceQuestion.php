<?php

namespace App\Models\V1\Choice;

use App\Models\V1\Question\Question;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChoiceQuestion extends Model
{
    protected $table='choice_question';
    protected $dates=['deleted_at'];
    use SearchAble, SortAble, TrashFilterAble, PaginateAble,SoftDeletes;
     public $searchable = ["id", "choice_id","question_id"];
    public $sortable = ['id', 'updated_at', 'question_id'];
    protected $fillable = [
        'choice_id', 'question_id'
    ];

    public function choices()
    {
        return $this->belongsTo(Choice::class,'choice_id');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
