<?php

namespace App\Http\Resources\API\V1\Admin\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        // with('properties')
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'suggested' => (boolean)$this->suggested,
            'deleted_at' => $this->deleted_at,
            'properties' => PropertyResource::collection($this->whenLoaded('properties')),
        ];
    }
}
