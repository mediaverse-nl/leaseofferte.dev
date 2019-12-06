<?php

namespace App\Http\Requests\Site\CalculatorForm;

use Illuminate\Foundation\Http\FormRequest;

class StepOneRequest extends FormRequest
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

        //        if(empty(request()->session()->get('product'))){
//            request()->session()->put('product', ['test']);
//        }else{
//            request()->session()->put('product', 'test 2');
//        }
//        $this->setRedirector();
//
//        return [
//            'aanschaf' => 'required',
//            'aanbetaling' => 'required',
//            'slottermijn' => 'required',
//            'looptijd' => 'required',
//        ];



    }

}
