<?php

namespace App\Http\Requests\API\V1\Site\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            'name' => 'required|max:50'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
        ];
    }
}
