<?php

namespace App\Http\Resources\API\V1\Admin\Question;

use App\Http\Resources\API\V1\Admin\Quiz\QuizResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionQuizResource extends JsonResource
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
            'question_id'=>$this->question_id,
            'quiz'=>new QuizResource($this->whenLoaded('quiz')),
            'question'=>new QuestionResource($this->whenLoaded('question'))
        ];
    }
}
