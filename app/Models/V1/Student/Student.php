<?php

namespace App\Model\V1\Student;

use App\Model\V1\Card\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'institution_id',
        'section_id',
        'user_id',
        'prefix',
        'roll_number'
    ];
    public function card(){
        return $this->hasOne(Card::class);
    }
}
