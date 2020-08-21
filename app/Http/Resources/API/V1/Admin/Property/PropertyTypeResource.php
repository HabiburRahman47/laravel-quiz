<?php

namespace App\Http\Resources\API\V1\Admin\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // with('properties')
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            // 'suggested'=>$this->suggested,
            //'created_by_id'=>$this->created_by_id,
            // 'user_interface'=>$this->user_interface,
            // 'created_at' =>$this->created_at,
            // 'updated_at' =>$this->updated_at,
            'properties' => PropertyResource::collection($this->whenLoaded('properties'))
        ];
    }
}
