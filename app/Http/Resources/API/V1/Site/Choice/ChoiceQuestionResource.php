<?php

namespace App\Http\Resources\API\V1\Site\Choice;

use Illuminate\Http\Resources\Json\JsonResource;

class ChoiceQuestionResource extends JsonResource
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
            'question_id'=>$this->question_id,
            'choice_id'=>$this->choice_id,
        ];
    }
}
