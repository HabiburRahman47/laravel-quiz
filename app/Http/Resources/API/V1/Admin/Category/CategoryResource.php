<?php

namespace App\Http\Resources\API\V1\Admin\Category;

use App\Http\Resources\API\V1\Admin\Quiz\QuizResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'parent_it' => $this->parent_id,
            'childrend' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
