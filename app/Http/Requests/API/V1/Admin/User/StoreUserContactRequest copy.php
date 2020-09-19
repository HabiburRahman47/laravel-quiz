<?php

namespace App\Http\Requests\API\V1\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserContactRequest extends FormRequest
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
            'name' => 'required|max:5',
            'phone_email' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'phone_email.required' => 'Email is required!'
        ];
    }
}
