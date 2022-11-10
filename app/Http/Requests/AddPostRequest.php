<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPostRequest extends FormRequest
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
            'title' => 'bail|required|max:255|min:10',
            'description' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Post required',
            'title.unique' => 'Post title unique',
            'title.max' => 'Max title 255 ',
            'title.min' => 'Less title 10',
            'description.required' => 'Description required',
            'category_id.required' => 'You have to select category',
            'content.required' => 'Content required',
        ];
    }
}
