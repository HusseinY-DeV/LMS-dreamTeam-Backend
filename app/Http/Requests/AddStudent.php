<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStudent extends FormRequest
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
            'first_name' => 'bail|required|min:3|max:255',
            'last_name' => 'bail|required|min:3|max:255',
            'email' => 'bail|required|unique:students|email',
            'phone' => 'bail|required|min:8|max: 255',
            'file' => 'bail|mimes:png,jpg|max:2048',
            'section_id' => 'required'
        ];
    }
}
