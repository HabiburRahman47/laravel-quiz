<?php

namespace App\Http\Requests\API\V1\Admin\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'session_id'=>'required',
            'total_question'=>'required',
            'total_right_ans'=>'required'
        ];
    }
}
