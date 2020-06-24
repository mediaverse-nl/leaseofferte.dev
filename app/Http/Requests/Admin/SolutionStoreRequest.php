<?php

namespace App\Http\Requests\Admin;

use App\Category;
use App\Solution;
use Illuminate\Foundation\Http\FormRequest;

class SolutionStoreRequest extends FormRequest
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
        $categories = \App\Category::pluck('id')->toArray();

        $categories = implode(',', $categories);

        return [
            'image' => 'nullable',
            'title' => 'required|min:3|max:70',
            'category_id' => 'required|in:'.$categories,
            'description' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
        ];
    }
}
