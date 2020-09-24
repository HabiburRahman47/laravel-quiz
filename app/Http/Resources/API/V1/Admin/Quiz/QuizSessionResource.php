<?php

namespace App\Http\Resources\API\V1\Admin\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizSessionResource extends JsonResource
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
            'quiz_id'=>$this->quiz_id,
            'created_by_id'=>$this->created_by_id
        ];
    }
}
