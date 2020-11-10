<?php

namespace App\Http\Requests\API\V1\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionChoiceRequest extends FormRequest
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
            'question_id'=>'required',
            'choice_id'=>'required'
        ];
    }
}
