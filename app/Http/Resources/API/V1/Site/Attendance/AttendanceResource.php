<?php

namespace App\Http\Resources\API\V1\Site\Attendance;

use App\Http\Resources\API\V1\Site\Course\CourseSectionResource;
use App\Http\Resources\API\V1\Site\Section\SectionResource;
use App\Http\Resources\API\V1\Site\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
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
            'info'=>$this->info,
            'notes'=>$this->notes,
            'teacher'=>new UserResource($this->whenLoaded('teacher')),
            // 'course'=>new CourseResource($this->whenLoaded('course')),
            'section'=>new SectionResource($this->whenLoaded('section')),
            'courseSection'=>new CourseSectionResource($this->whenLoaded('courseSection'))
        ];
    }
}
