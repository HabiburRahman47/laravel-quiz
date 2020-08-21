<?php

namespace App\Http\Resources\API\V1\Admin\Pivot;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyUserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
