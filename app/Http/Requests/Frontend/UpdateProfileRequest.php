<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|unique:users,email,' .$this->id. ',id',
            'password' => 'nullable|min:3',
            'image' => 'nullable|image|max:' . config('image.max_upload_size')
        ];
    }
}
