<?php

namespace App\Http\Resources\API\V1\Site\Choice;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChoiceCollection extends ResourceCollection
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
