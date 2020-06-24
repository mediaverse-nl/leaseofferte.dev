<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'g-recaptcha-response' => 'required|captcha',
            'naam' => 'required',
            'email' => 'required',
            'telefoonnummer' => 'required',
            'bericht' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'recaptcha is verplicht.'
        ];
    }
}
