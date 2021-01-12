<?php

namespace App\Http\Requests\API\V1\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'parent_id'=>'required'
        ];
    }
     public function messages()
    {
        return [
            'name.required'=>'Name is required',
            'parent_id.required'=>'Parent is required'
        ];
    }
}
