<?php

namespace App\Http\Resources\API\V1\Admin\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResultResource extends JsonResource
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
            'total_question'=>$this->total_question,
            'total_right_ans'=>$this->total_right_ans

        ];
    }
}
