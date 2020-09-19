<?php

namespace App\Http\Resources\API\V1\Admin\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($property) {
            return [
                'id' => $property->id,
                'name' => $property->name,
            ];
        });
    }
}
