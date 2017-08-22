<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class HotelCreateRequest extends FormRequest
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
            'name' => 'required|min:8|unique:hotels',
            'address' => 'required',
            'place_id' => 'required',
            'star' => 'required',
            'introduce' => 'required',
            // 'printer_list(enumtype)ace' => 'require ';
        ];
    }
}
