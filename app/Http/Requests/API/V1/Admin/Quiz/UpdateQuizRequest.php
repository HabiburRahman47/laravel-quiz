<?php

namespace App\Http\Requests\API\V1\Admin\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required',
            'config'=>'required',
            'category_id'=>'required'
        ];
    }
     public function messages()
    {
        return [
            'name.required'=>'Name is required',
            'description.required'=>'Description is required',
            'config.required'=>'Config is required',
            'category_id.required'=>'Category is required'
        ];
    }
}
