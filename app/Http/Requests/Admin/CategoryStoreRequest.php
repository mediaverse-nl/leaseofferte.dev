<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'value' => 'required|unique:category,value',
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'title is verplicht.',
            'value.unique' => 'title is al in gebruik.',
        ];
    }
}
