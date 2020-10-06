<?php

namespace App\Http\Resources\API\V1\Admin\Question;

use App\Http\Resources\API\V1\Admin\Choice\ChoiceQuestionResource;
use App\Http\Resources\API\V1\Admin\Choice\ChoiceResource;
use App\Http\Resources\API\V1\Admin\Quiz\QuizSessionAnswerResource;
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
            'choice'=>ChoiceResource::collection($this->whenLoaded('choices')),
            'quiz_session_ans'=>new QuizSessionAnswerResource($this->whenLoaded('quizSessionAns'))
        ];
    }
}
