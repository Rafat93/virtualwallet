<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|min:3|regex:/^[a-zA-Zà-ú0-9À-ú\s]+$/',
            'password' => 'min:3|',
            'nif' => 'nullable|min:1|max:9|',
            'file_foto' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ];
    }
}
