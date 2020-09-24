<?php

namespace App\Models\V1\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz_Session extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table='quiz_sessions';

}
