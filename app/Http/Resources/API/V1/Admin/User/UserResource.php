<?php

namespace App\Http\Resources\API\V1\Admin\User;

use App\Http\Resources\API\V1\Admin\Property\PropertyTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'=>$this->email,
            'porpertyTypes'=>PropertyTypeResource::collection($this->whenloaded('institutionTypes')),
            'userContacts'=>UserContactResource::collection($this->whenLoaded('userContacts'))
        ];
    }
}
