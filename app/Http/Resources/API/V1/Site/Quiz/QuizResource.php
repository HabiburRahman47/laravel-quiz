<?php

namespace App\Http\Resources\API\V1\Site\Quiz;

use App\Http\Resources\API\V1\Site\Choice\ChoiceQuestionResource;
use App\Http\Resources\API\V1\Site\Question\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'description'=>$this->description,
            'image'=>$this->image,
            'question'=>QuestionResource::collection($this->whenLoaded('questions'))
            //'question'=>new ChoiceQuestionResource($this->whenLoaded('choiceQuestion'))

        ];
    }
}
