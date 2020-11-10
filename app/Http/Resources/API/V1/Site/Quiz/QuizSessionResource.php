<?php

namespace App\Http\Resources\API\V1\Site\Quiz;

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
            'quiz_name'=>$this->quiz_name,
            'result'=>QuizSessionResource::collection($this->whenLoaded('result'))
            // 'result' => [
            //     'total_question'=>$this->result->total_question,
            //     'total_right_ans'=>$this->result->total_right_ans
            // ],
            // 'total_question_number'=>$this->total_question_number,
            // 'right_total_question_number'=>$this->right_total_question_number


        ];
    }
}
