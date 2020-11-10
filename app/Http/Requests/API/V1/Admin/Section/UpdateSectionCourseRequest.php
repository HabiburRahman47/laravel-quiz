<?php

namespace App\Http\Requests\API\V1\Admin\Section;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionCourseRequest extends FormRequest
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
            'section_id' => 'required',
            'course_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
        ];
    }
}
