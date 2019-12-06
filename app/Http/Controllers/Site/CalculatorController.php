<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Requests\Site\CalculatorForm\StepOneRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CalculatorController extends Controller
{
    public function store(Request $request)
    {
        if (session('formFields')){
            $objectGroup = ((object)decrypt(session('formFields')))->objectgroep;
            $category = (new Category())->where('id', '=', $objectGroup)->first();
            $fields = [];
            if (session('formSteps') >= 2){
                foreach ($category->dynamicFields()->where('form_part', '=', session('formSteps'))->get() as $f){
                     if (!empty($f->field_validation)){
//                         dd($f);
//                         if ('telefoonnummer_vast')

                        $fields[StripReplace($f->field_name)] = $f->field_validation;
                    }
                }
            }
        }
        if (session('formSteps') == 3){
            $validator = Validator::make($request->all(), $fields);
            $nextStep = 4;
        }
        if ( session('formSteps') == 2){
            $validator = Validator::make($request->all(), $fields);
            $nextStep = 3;
//            dd($validator);
        }
        if ( session('formSteps') == 1){
            $validator = Validator::make($request->all(), [
                'aanschaf' => 'required|numeric',
                'aanbetaling' => 'required|numeric',
                'slottermijn' => 'required|numeric',
                'looptijd' => 'required',
                'objectgroep' => 'required|numeric',
            ]);
            $nextStep = 2;
        }

//        dd($fields);
        session(['formFields' => encrypt($request->except(['_token']))]);
//        dd(1);
        if ($validator->fails()) {

            return redirect(url()->previous().'#stepsForm')
                ->withErrors($validator)
                ->withInput();
        }


        session(['formSteps' => $nextStep]);

        return redirect(url()->previous().'#stepsForm')->withInput();
    }

    public function formStep(Request $request){
        session(['formSteps' => $request->step]);

        return redirect(url()->previous().'#stepsForm')->withInput();
    }
}
