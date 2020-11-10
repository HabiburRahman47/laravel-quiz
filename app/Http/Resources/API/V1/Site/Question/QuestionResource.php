<?php

namespace App\Http\Resources\API\V1\Site\Question;

use App\Http\Resources\API\V1\Site\Choice\ChoiceQuestionResource;
use App\Http\Resources\API\V1\Site\Choice\ChoiceResource;
use App\Http\Resources\API\V1\Site\Quiz\QuizSessionAnswerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'image'=>$this->image,
            'question_type'=>$this->question_type,
            'tag'=>$this->tags,
            'choice'=>ChoiceResource::collection($this->whenLoaded('choices')),
            'quiz_session_ans'=>new QuizSessionAnswerResource($this->whenLoaded('quizSessionAns'))
        ];
    }
}
