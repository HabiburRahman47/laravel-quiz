<?php

namespace App\Model\V1\Card;

use App\Model\V1\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'institution_id',
        'student_id',
        'card_number'
    ];
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
