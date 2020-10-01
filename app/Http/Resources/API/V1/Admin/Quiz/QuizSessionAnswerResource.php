<?php

namespace App\Http\Resources\API\V1\Admin\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizSessionAnswerResource extends JsonResource
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
            'session_id'=>$this->session_id,
            'question_id'=>$this->question_id,
            'selected_choice_id'=>$this->selected_choice_id
        ];
    }
}
