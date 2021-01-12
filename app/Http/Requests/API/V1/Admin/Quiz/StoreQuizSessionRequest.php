<?php

namespace App\Http\Requests\API\V1\Admin\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizSessionRequest extends FormRequest
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
            'quiz_name'=>'required',
            'quiz_id'=>'required',
            'status'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'quiz_name.required'=>'Quiz Name is required',
            'quiz_id.required'=>'Quiz is required',
            'status.required'=>'Status is required'
        ];
    }
}
