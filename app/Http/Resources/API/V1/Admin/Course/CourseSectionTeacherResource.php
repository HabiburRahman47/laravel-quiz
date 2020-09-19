<?php

namespace App\Http\Resources\API\V1\Admin\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseSectionTeacherResource extends JsonResource
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
            'course_section_id'=>$this->course_section_id,
            'id'=>$this->teacher_id
        ];
    }
}
