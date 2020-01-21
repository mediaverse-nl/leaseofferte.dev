<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaticSolutionUpdateRequest extends FormRequest
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
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:3|max:70',
            'description' => 'required',
            'uitvoering' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'kleur' => 'required',
            'looptijd' => 'required|in:12,18,24,30,36,42,48,54,60,72|array|between:3,3',
            'kilometrage' => 'required|numeric',
            'catalogusprijs' => 'required|numeric',
            'bijtelling' => 'required|numeric',
            'inbegrepen' => 'nullable',
            'meta_title' => 'nullable|max:80',
            'meta_description' => 'nullable|max:170',
        ];
    }
}
