<?php

namespace App\Http\Resources\API\V1\Admin\Property;

use App\Http\Resources\API\V1\Admin\Event\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'private_name'=>$this->private_name,
            'description'=>$this->description,
            // 'property_type_id'=>$this->type_id,
            //'createdById'=>$this->created_by_id,
            //'property_type' => (new PropertyTypeResource($this->whenLoaded('propertyType'))),
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,
            //'events' => EventResource::collection($this->whenLoaded('events')),
        ];
    }
}
