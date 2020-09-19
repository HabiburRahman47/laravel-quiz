<?php

namespace App\Model\V1\Choice;

use App\Model\V1\Question\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
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
