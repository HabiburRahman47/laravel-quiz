<?php

namespace App\Http\Resources\API\V1\Admin\Course;

use App\Http\Resources\API\V1\Admin\Attendance\AttendanceResource;
use App\Http\Resources\API\V1\Admin\Institution\InstitutionResource;
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
            'institution_id'=>$this->institution_id,
            'institution'=>new InstitutionResource($this->whenLoaded('institution')),
            'attendances'=>AttendanceResource::collection($this->whenLoaded('attendances'))
        ];
    }
}
