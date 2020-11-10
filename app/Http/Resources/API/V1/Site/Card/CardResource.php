<?php

namespace App\Http\Resources\API\V1\Site\Card;

use App\Http\Resources\API\V1\Site\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'property_id'=>$this->property_id,
            'student_id'=>$this->student_id,
            'card_number'=>$this->card_number,
            'student'=>new StudentResource($this->whenloaded('student'))
        ];
    }
}
