<?php

namespace App\Models\V1\Student;

use App\Models\V1\Card\Card;
use App\Models\V1\Property\Property;
use App\Models\V1\Section\Section;
use App\Traits\Filters\PaginateAble;
use App\Traits\Filters\SearchAble;
use App\Traits\Filters\SortAble;
use App\Traits\Filters\TrashFilterAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes,SortAble,SearchAble,PaginateAble,TrashFilterAble;
    public $searchable = ["id","roll_number"];
    public $sortable = ['id', 'updated_at', 'roll_number'];
    protected $dates=['deleted_at'];
    protected $fillable=[
        'property_id',
        'section_id',
        'user_id',
        'prefix',
        'roll_number',
    ];
    public function cards()
    {
    return $this->morphMany(Card::class, 'cardable');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }
}
