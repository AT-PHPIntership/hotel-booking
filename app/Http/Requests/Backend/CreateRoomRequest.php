<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
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
            'name' => 'required|max:50',
            'descript' => 'required',
            'price' => 'required|numeric',
            'max_guest' => 'required|integer',
            'total' => 'required|integer',
            'images' => 'required|array',
            'images.*' => 'image|max:' . config('image.max_upload_size')
        ];
    }
}
