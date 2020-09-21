<?php

namespace App\Models\V1\Card;

use App\Models\V1\Student\Student;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes,SortAble,PaginateAble,TrashFilterAble,SearchAble;
    protected $dates=['deleted_at'];

    public $searchable = ["id"];
    public $sortable = ['id', 'updated_at'];

    protected $fillable=[
        'id',
        'property_id',
        'student_id',
        'card_number'
    ];
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
