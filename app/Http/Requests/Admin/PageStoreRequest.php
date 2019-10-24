<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'slug' => 'required|alpha_dash|unique:page',
            'title' => 'required|max:120|min:1',
            'body' => 'required|min:1',
            'meta_title' => 'nullable|max:80',
            'meta_description' => 'nullable|max:170',
        ];
    }
}
