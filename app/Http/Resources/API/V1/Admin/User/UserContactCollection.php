<?php

namespace App\Http\Resources\API\V1\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserContactCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
