<?php

namespace App\Http\Requests\API\V1\Site\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'property_id'=>'required',
            'section_id'=>'required',
            'prefix'=>'required',
            'roll_number'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'property_id.required' => 'Property is required!',
            'section_id.required' => 'Section is required!',
            'prefix.required' => 'Prefix is required!',
            'roll_number.required' => 'Roll Number is required!',
        ];
    }
}
