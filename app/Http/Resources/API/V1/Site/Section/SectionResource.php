<?php

namespace App\Http\Resources\API\V1\Site\Section;

use App\Http\Resources\API\V1\Site\Course\CourseResource;
use App\Http\Resources\API\V1\Site\Department\DepartmentResource;
use App\Http\Resources\API\V1\Site\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'department_id'=>$this->department_id,
            'department'=>new DepartmentResource($this->whenloaded('department')),
            'student'=>StudentResource::collection($this->whenloaded('students')),
            'courses'=>CourseResource::collection($this->whenLoaded('courses'))
        ];
    }
}
