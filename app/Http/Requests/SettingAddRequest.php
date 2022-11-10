<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingAddRequest extends FormRequest
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
            'config_key' => 'bail|required|unique:settings|max:255|min:5',
            'config_value' => 'bail|required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'config_key.required' => 'Tên không được để trống',
            'config_key.unique' => 'Tên không được trùng',
            'config_key.max' => 'Tên không được vượt quá 255 kí tự',
            'config_key.min' => 'Tên không được dưới 5 kí tự',
            'config_value.required' => 'Giá trị không được để trống',
            'config_value.unique' => 'Giá trị không được trùng',
            'config_value.max' => 'Tên không được vượt quá 255 kí tự',
            'config_value.min' => 'Tên không được dưới 5 kí tự',
        ];
    }
}
