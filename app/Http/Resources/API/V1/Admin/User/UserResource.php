<?php

namespace App\Http\Resources\API\V1\Admin\User;

use App\Http\Resources\API\V1\Admin\Institution\InstitutionTypeResource;
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
            'institutionTypes'=>InstitutionTypeResource::collection($this->whenloaded('institutionTypes')),
            'userContacts'=>userContactResource::collection($this->whenLoaded('userContacts'))
        ];
    }
}
