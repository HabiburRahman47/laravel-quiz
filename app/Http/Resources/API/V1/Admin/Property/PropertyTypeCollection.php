<?php

namespace App\Http\Resources\API\V1\Admin\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($propertyType) {
            return [
                'id' => $propertyType->id,
                'name' => $propertyType->name,
            ];
        });
    }
}
