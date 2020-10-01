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
            'quiz_id'=>$this->quiz_id,
            'session_id'=>$this->id,
            'total_question_number'=>$this->objects()->count()
        ];
    }
}
