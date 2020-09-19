<?php

namespace App\Http\Resources\API\V1\Admin\Student;

use App\Http\Resources\API\V1\Admin\Card\CardResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'prefix'=>$this->prefix,
            'roll_number'=>$this->roll_number,
            'card'=>new CardResource($this->whenloaded('card'))
        ];
    }
}
