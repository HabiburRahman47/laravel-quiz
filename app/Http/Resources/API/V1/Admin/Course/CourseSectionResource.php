<?php

namespace App\Http\Resources\API\V1\Admin\Course;

use App\Course;
use App\Http\Resources\API\V1\Admin\Section\SectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseSectionResource extends JsonResource
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
            'course_id'=>$this->course_id,
            'section_id'=>$this->section_id,
            'course'=>new CourseResource($this->course),
            'section'=>new SectionResource($this->section)
        ];
    }
}
