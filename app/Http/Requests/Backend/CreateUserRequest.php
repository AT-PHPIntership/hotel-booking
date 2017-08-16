<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|max:50|unique:users',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
        ];
    }
}
