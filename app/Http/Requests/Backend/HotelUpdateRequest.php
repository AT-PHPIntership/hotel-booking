<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class HotelUpdateRequest extends FormRequest
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
            'address' => 'required',
            'place_id' => 'required',
            'star' => 'required',
            'introduce' => 'required',
            'name' => 'min:8|unique:hotels,name,' . $this->id . ',id',
            'images.*' => 'image|max:' . config('image.max_upload_size')
        ];
    }
}
