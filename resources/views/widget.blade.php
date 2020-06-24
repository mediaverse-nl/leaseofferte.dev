<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="copyright" content="Leaseofferte.com - All rights reserved">
    <meta name="author" content="Lease Offerte">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/octoshrimpy/bulma-o-steps/master/bulma-steps.min.css">
    <link rel="stylesheet" href="/css/calculator.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .modal{
            display: block !important;
        }
        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            height: 250px;
            overflow-y: auto;
        }
{{--        .form-control{--}}
{{--            border-color: #D9E9EE;--}}
{{--            border-radius: 4px;--}}
{{--        }--}}
{{--        .btn.dropdown-toggle.btn-light{--}}
{{--            border-color: #D9E9EE !important;--}}
{{--        }--}}
{{--        .slick-slide {--}}
{{--            outline: none--}}
{{--        }--}}
{{--        .btn-default{--}}
{{--            background: #f78e0c !important;--}}
{{--            color: #FFFFFF;--}}
{{--        }--}}
{{--        .btn{--}}
{{--            border-radius: 4px !important;--}}
{{--        }--}}
{{--        a {--}}
{{--            color: inherit;--}}
{{--            text-decoration: none;--}}
{{--            background-color: transparent;--}}
{{--        }--}}
{{--        html,--}}
{{--        body {--}}
{{--            background: #F1F7F9 !important;--}}
{{--            height: 100%;--}}
{{--            font-style: inherit;--}}
{{--            font-family: "Roboto Light", sans-serif;--}}
{{--        }--}}
    </style>


</head>
<body>

    @php
        if (session('formSteps') === null){
            session(['formSteps' => 1]);
        }

        if (!empty(session('formFields'))){
            $fields = (object)decrypt(session('formFields'));
        }else{
            $fields = (object)[];
        }

        $solutions = (new \App\Solution())
            ->with('category.solutions')
            ->orderBy('title', 'asc')
            ->get();

        $objectgroep = null;
        $objects = [];

        $solutions = $solutions;

        if (isset($fields->object)){
            $category = $solutions->find($fields->object)->category;
        }

        if (isset($preselectedObject)){
            $solutionID = isset($preselectedObject) ? request('id') : $fields->object;
            $solutions = $solutions->find($solutionID)->category->solutions;
            $category = $solutions->find($solutionID)->category;
            //todo hier moet aanpassening gemaakt worden
            //add preselected sub category
        }

        $solutions = $solutions->pluck('title', 'id');
    @endphp

    <div class="card" style="margin-top: 0px;" id="stepsForm">
        {{--<div class="card" style="margin-top: 60px;" id="stepsForm">--}}
        <div class="card-header" style="{!! isset($preselectedObject) ? 'border-radius: 4px !important;' : null !!}; height: 90px; background: #F0F6F9 !important;">
            <div class="steps is-horizontal">
                <div class="steps-segment is-inline has-gaps {!! (session('formSteps') == 2 || session('formSteps') == 3 || session('formSteps') == 4) ? '' : ' is-active' !!}">
                    <span class="steps-marker {!! (session('formSteps') >= 2 || session('formSteps') == 3) ? '' : 'is-hollow' !!}">1</span>
                    <div class="steps-content">
                        <p class="is-size-5">Stap</p>
                    </div>
                </div>
                <div class="steps-segment is-inline has-gaps {!! session('formSteps') == 2 ? 'is-active' : '' !!}">
                    <span class="steps-marker {!! (session('formSteps') >= 3) ? '' : 'is-hollow' !!}">2</span>
                    <div class="steps-content">
                        <p class="is-size-5">Stap</p>
                    </div>
                </div>
                <div class="steps-segment {!! session('formSteps') == 3 ? 'is-active' : '' !!}">
                    <span class="steps-marker {!! (session('formSteps') >= 4) ? '' : 'is-hollow' !!}">3</span>
                    <div class="steps-content">
                        <p class="is-size-5">Stap</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="leaseAccordion">
{{--asdsad--}}
{{--                @include('components.success-order-model')--}}
{{--sadass--}}
                @if(isset($preselectedObject))
                    <p style="color: #006A8E;" class="text-center h3">Uw Leasebedrag per maand <b style="color:#7FAF1B;" id="leasePrice" class="leasePrice">&euro; 0</b></p>
                @endif
                {!! Form::model((session('formFields') !== null ? decrypt(session('formFields')) : []), ['route' => 'site.calculator.store']) !!}
                <div class="row setup-content {!! (session('formSteps') != 1) ? 'd-none' : '' !!}" id="step-1">
                    <div class="col-md-12">
                        <div class="row text-center iconRow">
                            <div class="col-3 col-md-2">
                                <a href="{!! route('site.solution.show', ['tractor', 39]) !!}">
                                    <img src="/img/icons/Layer-6.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-2 d-none d-sm-block">
                                <a href="{!! route('site.solution.show', ['auto', 60]) !!}">
                                    <img src="/img/icons/Layer-10.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-3 col-md-2">
                                <a href="{!! route('site.solution.show', ['graafmachine', 11]) !!}">
                                    <img src="/img/icons/Layer-8.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-3 col-md-2">
                                {{--                                <a href="{!! route('site.solution.show', ['', 1]) !!}">--}}
                                <img src="/img/icons/Layer-7.jpg" alt="">
                                {{--                                </a>--}}
                            </div>
                            <div class="col-2 col-md-2">
                                <a href="{!! route('site.solution.show', ['trucks', 28]) !!}">
                                    <img src="/img/icons/Layer-9.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-2 d-none d-sm-block">
                                <a href="{!! route('site.solution.show', ['heftruck', 75]) !!}">
                                    <img src="/img/icons/Layer-11.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            {!! Form::hidden('object', isset($category) ? $category->solutions->first()->category->id : null, null) !!}
                            {!! Form::select('object', $solutions, isset($preselectedObject) ? request('id') : null, [
                                'data-size="10"',
                                'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('object') ? '': ' show-error-line').'"',
                                'title="--- object * ---"',
                                'placeholder' => '--- object * ---',
                                'data-live-search-placeholder="Zoek hier op trefwoord"',
                                'data-live-search="true"',
                                'class' => 'selectpicker form-control',
                                'id' => 'object'
                            ]) !!}
                            @include('components.error', ['field' => 'object'])
                        </div>

                        <div class="form-group">
                            {!! Form::text('aanschaf', null, [
                                'placeholder' => 'Aanschafprijs *',
                                'class' => 'moneyFormat withIcon form-control'.(!$errors->has('aanschaf') ? '': ' is-invalid '),
                                'id' => 'aanschaf'
                            ]) !!}
                            @include('components.error', ['field' => 'aanschaf'])
                        </div>

                        <div class="form-group">
                            {!! Form::text('aanbetaling', null, [
                                'placeholder' => 'Aanbetaling ',
                                'class' => 'moneyFormat withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),
                                'id' => 'aanbetaling'
                            ]) !!}

                            @include('components.error', ['field' => 'aanbetaling'])
                        </div>

                        <div class="form-group">
                            {!! Form::text('slottermijn', null, [
                                'placeholder' => 'Slottermijn ',
                                'class' => 'moneyFormat withIcon form-control'.(!$errors->has('slottermijn') ? '': ' is-invalid '),
                                'id' => 'slottermijn'
                            ]) !!}

                            @include('components.error', ['field' => 'slottermijn'])
                        </div>
                        <div class="form-group">
                            {!! Form::select('looptijd', [
                               '12 maanden' => '12 maanden',
                               '18 maanden' => '18 maanden',
                               '24 maanden' => '24 maanden',
                               '30 maanden' => '30 maanden',
                               '36 maanden' => '36 maanden',
                               '42 maanden' => '42 maanden',
                               '48 maanden' => '48 maanden',
                               '54 maanden' => '54 maanden',
                               '60 maanden' => '60 maanden',
                               '72 maanden' => '72 maanden',
                               '84 maanden' => '84 maanden',
                           ], null, [
                               'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('looptijd') ? '': ' show-error-line').'"',
                               'placeholder' => '--- looptijd * ---',
                               'class' => 'selectpicker form-control'.(!$errors->has('looptijd') ? '': ' is-invalid '),
                               'id' => 'looptijd'
                           ]) !!}
                            @include('components.error', ['field' => 'looptijd'])
                        </div>

                        <small class="text-muted"> Alle velden met een * zijn verplicht.</small>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">volgende stap</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content {!! (session('formSteps') != 2) ? 'd-none' : '' !!}" id="step-2">
                    <div class="col-md-12">
                        <div class="formPartTwo">
                            @if(isset($category))
                                @foreach($category->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'ASC')->get() as $f)
                                    <div class="form-group">
                                        @php
                                            $fieldRequired = str_contains($f->field_validation, "required") ?  "*": "";
                                            $placeholder = ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name);
                                        @endphp
                                        @switch($f->field_type)
                                            @case('text')
                                            {!! Form::text(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('textarea')
                                            {!! Form::textarea(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('number')
                                            {!! Form::number(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                        @endswitch
                                        @include('components.error', ['field' => StripReplace($f->field_name)])
                                    </div>
                                @endforeach
                            @endif
                            <small class="text-muted"> Alle velden met een * zijn verplicht.</small>
                            <br>
                            <br>
                            <div class="row" >
                                <div class="col-6">
                                    <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(1)'>vorige</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">verder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content {!! (session('formSteps') != 3) ? 'd-none' : '' !!}" id="step-3">
                    <div class="col-md-12">
                        @if(isset($category))
                            @foreach($category->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get() as $f)
                                <div class="form-group">
                                    @php
                                        $fieldRequired = str_contains($f->field_validation, "required") ?  "*": "";
                                        $placeholder = ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name);
                                    @endphp
                                    @switch($f->field_type)
                                        @case('text')
                                        {!! Form::text(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('textarea')
                                        {!! Form::textarea(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('number')
                                        {!! Form::number(StripReplace($f->field_name), null, ['placeholder' => $placeholder." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                    @endswitch
                                    @include('components.error', ['field' => StripReplace($f->field_name)])
                                </div>
                            @endforeach
                        @endif

                        <small class="text-muted"> Alle velden met een * zijn verplicht.</small>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(2)'>vorige</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">afronden</button>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('formSteps') == 4)
{{--                    <div data-toggle="modal" data-target="#checker" data-placement="top" style="display: inline-block;" class="btn btn-lg btn-back ">--}}
{{--                        <a class="" data-toggle="tooltip" data-placement="top" title="{!! '' or '' !!}" style="color: #006A8E;">--}}
{{--                            <i class="fa fa-info-circle" style="color: #006A8E;"></i>--}}
{{--                            controleer uw gegevens--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <!-- Modal -->--}}
{{--                    <div class="modal fade" id="checker" tabindex="-1" role="dialog" aria-labelledby="checkerLabel" aria-hidden="true">--}}
{{--                        <div class="modal-dialog mo dal-lg" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title" id="checkerLabel"> controleer uw gegevens</h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body" style="overflow: hidden !important;">--}}
{{--                                    @component('components.info-checker', ['edit' => true])--}}
{{--                                    @endcomponent--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    <button type="button" class="btn btn-secondary" style="border-radius: 0px;" data-dismiss="modal">Terug</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {!! Editor('calculator_bericht', 'richtext', false, "uw formulier is verzonden..") !!}
                    <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">
                        <i class="fas fa- fa-envelope" style="color: #ffffff;"></i>
                        verzenden
                    </button>
                    <br>
                    <div class="form-group">
                        <small style="color: #6c757d;">Door verder te gaan bevestig je akkoord te gaan met de
                            <a href="{!! route('site.terms') !!}">algemene voorwaarden</a>.
                        </small>
                    </div>
                @endif
                {!! Form::close() !!}
            </div>
            {!! Form::open(['route' => 'site.calculator.formStep', 'id' => 'previousForm']) !!}
            <input type='hidden' id="to-previous" name="step" />
            {!! Form::close() !!}
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"  ></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/bindings/inputmask.binding.min.js"></script>
    <script type="text/javascript" src="/js/calculator.js"></script>
    <script type="text/javascript">
        function submitForm(step) {
            $("#to-previous").val(step);
            $("#previousForm").submit();
        }

    </script>
    <script language="javaScript">
        function resize()
        {
            window.parent.autoResize();
        }

        $(window).on('resize', resize);
    </script>

</body>
</html>


