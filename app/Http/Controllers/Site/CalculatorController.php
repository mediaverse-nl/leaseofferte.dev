<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Requests\Site\CalculatorForm\StepOneRequest;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CalculatorController extends Controller
{
    public function store(Request $request)
    {
        if ( session('formSteps') == 1){
            $validator = Validator::make($request->all(), [
                'aanschaf' => 'required|numeric',
                'aanbetaling' => 'required|numeric',
                'slottermijn' => 'required|numeric',
                'looptijd' => 'required',
                'object' => 'required|numeric',
            ]);
            $nextStep = 2;
            if ($validator->fails()) {
                return redirect(url()->previous().'#stepsForm')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if (session('formFields')){
            $objectGroup = $request->object;
            $category = (new Solution())->find($objectGroup)->category;
            $fields = [];
            if (session('formSteps') >= 2){
                foreach ($category->dynamicFields()->where('form_part', '=', session('formSteps'))->get() as $f){
                     if (!empty($f->field_validation)){
                        $fields[StripReplace($f->field_name)] = $f->field_validation;
                    }
                }
            }
        }
        if (session('formSteps') == 4){
            $validator = Validator::make($request->all(), $fields);
            $nextStep = 5;
        }
        if (session('formSteps') == 3){
            $validator = Validator::make($request->all(), $fields);
            $nextStep = 4;
        }
        if ( session('formSteps') == 2){
            $validator = Validator::make($request->all(), $fields);
            $nextStep = 3;
        }

        session(['formFields' => encrypt($request->except(['_token']))]);

        if ($validator->fails()) {
            return redirect(url()->previous().'#stepsForm')
                ->withErrors($validator)
                ->withInput();
        }

        session(['formSteps' => $nextStep]);

        if ($this->lastStep(session('formSteps')))
        {
//            dd('send mail');
        }

        return redirect(url()->previous().'#stepsForm')->withInput();
    }

    public function formStep(Request $request){
        session(['formSteps' => $request->step]);
        $this->lastStep($request->step);
        return redirect(url()->previous().'#stepsForm')->withInput();
    }

    protected function lastStep($step){
        if ($step >= 5){
            session(['formFields' => null]);
            session(['formSteps' => 1]);
            return true;
        }
        return false;
    }
}
