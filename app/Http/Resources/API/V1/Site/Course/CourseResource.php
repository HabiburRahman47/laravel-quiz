<?php

namespace App\Http\Resources\API\V1\Site\Course;

use App\Http\Resources\API\V1\Site\Attendance\AttendanceResource;
use App\Http\Resources\API\V1\Site\Property\PropertyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name'=>$this->name,
            'property_id'=>$this->property_id,
            'institution'=>new PropertyResource($this->whenLoaded('institution')),
            'attendances'=>AttendanceResource::collection($this->whenLoaded('attendances'))
        ];
    }
}
