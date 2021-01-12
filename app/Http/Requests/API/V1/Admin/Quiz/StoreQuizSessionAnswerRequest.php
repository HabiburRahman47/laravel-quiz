<?php

namespace App\Http\Requests\API\V1\Admin\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizSessionAnswerRequest extends FormRequest
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
            'question_id'=>'required',
            'selected_choice_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'session_id.required'=>'Session is required',
            'question_id.required'=>'Question is required',
            'selected_choice_id.required'=>'Choice is required'
        ];
    }

}
