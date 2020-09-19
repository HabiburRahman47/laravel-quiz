<?php

namespace App\Http\Resources\API\V1\Admin\Department;

use App\Http\Resources\API\V1\Admin\Section\SectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'sections'=>SectionResource::collection($this->whenloaded('sections'))
        ];
    }
}
