<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Requests\Site\CalculatorForm\StepOneRequest;
use App\Mail\AdminOrderRequest;
use App\Mail\OperationalOrderRequest;
use App\Mail\OrderRequest;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CalculatorController extends Controller
{
    public function store(Request $request)
    {
        if ( session('formSteps') == 1){
            $validator = Validator::make($request->all(), [
                'aanschaf' => 'required|numeric',
                'aanbetaling' => '',
                'slottermijn' => '',
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

        if ($this->lastStep($nextStep))
        {
            Mail::to($request->email)
                ->send(new OrderRequest($request->except(['_token', 'g-recaptcha-response'])));

            Mail::to(env('MAIL_ADMIN'))
                ->send(new AdminOrderRequest($request->except(['_token', 'g-recaptcha-response'])));

            session()->flash('orderStatus', 'success');

            return redirect(url()->previous().'#stepsForm');
        }else{
            session(['formSteps' => $nextStep]);
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
            session(['formSteps' => null]);
            return true;
        }
        return false;
    }

    public function operational(Request $request)
    {
//        dd($request['bestanden']);
//        dd($request->except(['g-recaptcha-response']));
        $validator = Validator::make($request->all(), [
            'jaarkilometrage' => 'required|numeric',
            'looptijd' => 'required',
            'winterbanden' => 'required',
            'vervangend_vervoer' => 'required',
            'voornaam_en_achternaam' => 'required',
            'bedrijfsnaam' => 'required',
            'kvk_nummer' => 'required',
            'adres' => 'required',
            'postcode' => 'required',
            'plaats' => 'required',
            'email' => 'required',
            'telefoonnummer' => 'required',
            'bestanden.*' => 'mimes:mimes:jpg,jpeg,png,bmp,doc,docx,pdf|max:5000',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'recaptcha is verplicht.'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }else {
            Mail::to($request->email)
                ->send(new OperationalOrderRequest($request->except(['_token', 'g-recaptcha-response'])));

//            Mail::to(env('MAIL_ADMIN'))
//                ->send(new AdminOrderRequest($request->except(['_token', 'g-recaptcha-response'])));

            session()->flash('orderStatus', 'success');

            return redirect(url()->previous().'#stepsForm');
        }
    }
}
