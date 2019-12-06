
@php
    if (session('formSteps') === null){
        session(['formSteps' => 1]);
    }

    if (!empty(session('formFields'))){
        $fields = (object)decrypt(session('formFields'));
    }else{
        $fields = (object)[];
    }

    $categories = (new \App\Category())->orderBy('value', 'asc')->get();

    $objectgroep = null;
    $objects = [];

    if (isset($fields->objectgroep) || isset($preselectedObject)){
        $objectgroep = isset($preselectedObject) ? $preselectedObject : $fields->objectgroep;
        $category = $categories->find($objectgroep);
        $objects = $category->solutions()->orderBy('title', 'desc')->pluck('title', 'id');
    }

    $categories = $categories->pluck('value', 'id');
@endphp

<div class="card" style="margin-top: 60px;" id="stepsForm">

    <style>
        .steps-segment{
            color: #009FD6 !important;
        }
        .steps:not(.is-hollow) .steps-marker:not(.is-hollow) {
            background-color: #009FD6;
            color: #fff;
        }
        .steps-segment:after {
            background-color: #009FD6;
        }
        .steps.is-hollow .is-active .steps-marker, .steps .is-active .steps-marker.is-hollow {
            border-color: #009FD6;
        }
        .steps{
            font-size: inherit !important;
        }
        .steps .my-step-style{
            margin-bottom: 0px !important;
        }
        .iconRow{
            font-size: 30px;
            color: #DAE9ED !important;
        }
        .btn-orange{
            background: #f78e0c !important;
            color: white;
        }
        .btn-back{
            background: #F0F6F9  !important;
        }

        /*.steps:not(.is-horizontal):not(.is-short) .steps-segment:not(:last-child) {*/
        /*    flex-basis: 2rem !important;*/
        /*    flex-grow: 1;*/
        /*    flex-shrink: 1;*/
        /*}*/

        /*.steps:not(.is-vertical) .steps-segment:not(:last-child) {*/
        /*    flex-basis: 2rem !important;*/
        /*    flex-grow: 1;*/
        /*    flex-shrink: 1;*/
        /*}*/
        /*.steps .steps-segment {*/
        /*    position: relative;*/
        /*}*/
        /*.steps-segment {*/
        /*    color: #009FD6 !important;*/
        /*}*/
        /*.steps-segment {*/
        /*    list-style: none;*/
        /*}*/
        /**, *::before, *::after {*/
        /*    box-sizing: border-box;*/
        /*}*/
        .iconRow div i {
            text-align:center;
        }
    </style>

    <div class="card-header" style="height: 90px; background: #F0F6F9 !important;">
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
            @if(isset($preselectedObject))
                <p style="color: #006A8E;" class="text-center">Leasebedrag per maand: <b style="color:#7FAF1B;" id="leasePrice"></b> of lager</p>
            @endif
            {!! Form::model((session('formFields') !== null ? decrypt(session('formFields')) : []), ['route' => 'site.calculator.store']) !!}
                <div class="row setup-content {!! (session('formSteps') != 1) ? 'd-none' : '' !!}" id="step-1">
                    <div class="col-md-12">
                        <div class="row text-center iconRow">
                            <div class="col-3 col-md-2">
                                <i class="fa fa-car"></i>
                            </div>
                            <div class="col-3 col-md-2">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="col-3 col-md-2">
                                <i class="fa fa-truck-pickup"></i>
                            </div>
                            <div class="col-2 col-md-2">
                                <i class="fa fa-tractor"></i>
                            </div>
                            <div class="col-2 d-none d-sm-block">
                                <i class="fa fa-ship"></i>
                            </div>
                            <div class="col-2 d-none d-sm-block">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Aanschaf<b>*</b></label>
                            {!! Form::number('aanschaf', null, ['class' => 'form-control'.(!$errors->has('aanschaf') ? '': ' is-invalid '),'id' => 'aanschaf']) !!}
                            @include('components.error', ['field' => 'aanschaf'])
                        </div>

                        <div class="form-group">
                            <label class="control-label">Aanbetaling<b>*</b></label>
                            {!! Form::text('aanbetaling', null, ['class' => 'form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            @include('components.error', ['field' => 'aanbetaling'])
                        </div>

                        <div class="form-group">
                            <label class="control-label">Slottermijn<b>*</b></label>
                            {!! Form::text('slottermijn', null, ['class' => 'form-control'.(!$errors->has('slottermijn') ? '': ' is-invalid '),'id' => 'slottermijn']) !!}
                            @include('components.error', ['field' => 'slottermijn'])
                        </div>
                        <div class="form-group">
                            <label class="control-label">Looptijd<b>*</b></label>
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
                            ],  null,['placeholder' => '--- selecteer ---', 'class' => 'form-control'.(!$errors->has('looptijd') ? '': ' is-invalid '),'id' => 'looptijd']) !!}
                            @include('components.error', ['field' => 'looptijd'])
                        </div>
                        @if(isset($preselectedObject))
                            {!! Form::hidden('objectgroep', $preselectedObject) !!}
                            <div class="form-group">
                                <label class="control-label">Objectgroep<b>*</b></label>
                                {!! Form::select('objectgroep', $categories,  $preselectedObject,['placeholder' => '--- selecteer ---','disabled','class' => 'form-control'.(!$errors->has('objectgroep') ? '': ' is-invalid '),'id' => 'objectgroep']) !!}
                                @include('components.error', ['field' => 'objectgroep'])
                            </div>
                            <div class="form-group">
                                <label class="control-label">Object<b>*</b></label>
                                {!! Form::select('object', $objects,  null, ['class' => 'form-control'.(!$errors->has('object') ? '': ' is-invalid '),'id' => 'object']) !!}
                                @include('components.error', ['field' => 'object'])
                            </div>
                        @else
                            <div class="form-group">
                                <label class="control-label">Objectgroep<b>*</b></label>
                                {!! Form::select('objectgroep', $categories,  null,['placeholder' => '--- selecteer ---','class' => 'form-control'.(!$errors->has('objectgroep') ? '': ' is-invalid '),'id' => 'objectgroep']) !!}
                                @include('components.error', ['field' => 'objectgroep'])
                            </div>
                        @endif
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
                            @if(!isset($preselectedObject))
                                <div class="form-group">
                                    <label class="control-label">object<b>*</b></label>
                                    {!! Form::select('object', $objects,  null, ['class' => 'form-control'.(!$errors->has('object') ? '': ' is-invalid '),'id' => 'object']) !!}
                                    @include('components.error', ['field' => 'object'])
                                </div>
                            @endif
                            @if(isset($category))
                                @foreach($category->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'DESC')->get() as $f)
                                    <div class="form-group">
{{--                                        {!!dd( $errors->all()) !!}--}}
                                        <label class="control-label">{!! ucfirst($f->field_name) !!}{!! str_contains($f->field_validation, 'required') ? "<b>*</b>" : ''!!}</label>
                                        @switch($f->field_type)
                                            @case('text')
                                                {!! Form::text(StripReplace($f->field_name), null, ['class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('textarea')
                                                {!! Form::textarea(StripReplace($f->field_name), null, ['rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('number')
                                                {!! Form::number(StripReplace($f->field_name), null, ['class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
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
                                    <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(1)'>vorige</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">volgende</button>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="row setup-content {!! (session('formSteps') != 3) ? 'd-none' : '' !!}" id="step-3">
                    <div class="col-md-12">
                        @if(isset($category))
                            @foreach($category->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'DESC')->get() as $f)
                                <div class="form-group">
                                    <label class="control-label">{!! ucfirst($f->field_name) !!}{!! str_contains($f->field_validation, 'required') ? "<b>*</b>" : ''!!}</label>
                                    @switch($f->field_type)
                                        @case('text')
                                        {!! Form::text(StripReplace($f->field_name), null, ['class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('textarea')
                                        {!! Form::textarea(StripReplace($f->field_name), null, ['rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('number')
                                        {!! Form::number(StripReplace($f->field_name), null, ['class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                    @endswitch
                                    @include('components.error', ['field' => StripReplace($f->field_name)])
                                </div>
                            @endforeach
                        @endif


                        <div class="form-group">
                            <small>Door verder te gaan naar de volgende stap bevestig je akkoord te gaan met de
                                <a href="{!! route('site.terms') !!}">algemene voorwaarden</a>.</small>
                        </div>
                        <small class="text-muted"> Alle velden met een * zijn verplicht.</small>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(2)'>vorige</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-orange btn-lg btn-block pull-right" type="submit">verstuur</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            @if(session('formSteps') == 4)

                {!! Editor('calculator_bericht', 'richtext', false, "uw formulier is verzonden..") !!}

            @endif

        </div>

        {!! Form::open(['route' => 'site.calculator.formStep', 'id' => 'previousForm']) !!}
            <input type='hidden' id="to-previous" name="step" />
        {!! Form::close() !!}

    </div>
</div>

@push('js')
    <script language="javascript" type="text/javascript">

        function submitForm(step) {
            $("#to-previous").val(step);

            $("#previousForm").submit();
        }

        calculation();

        function calculation(){
            var aanschaf = parseFloat($("#aanschaf").val())
            var aanbetaling = parseFloat($("#aanbetaling").val())
            var slottermijn = parseFloat($("#slottermijn").val())
            var looptijd = parseFloat($("#looptijd").val().substr(0, 2));

            var maandBedrag = (aanschaf - aanbetaling - slottermijn) / looptijd;

            @if(isset($category))
                if(aanschaf < 25000){
                    var financeRate = {!! isset(explode(",", $category->interest_rate)[0]) ? explode(",", $category->interest_rate)[0] : 0 !!};
                }else if(aanschaf >= 25000 && aanschaf < 50000){
                    var financeRate = {!! isset(explode(",", $category->interest_rate)[1]) ? explode(",", $category->interest_rate)[1] : 0 !!};
                }else{
                    var financeRate = {!! isset(explode(",", $category->interest_rate)[2]) ? explode(",", $category->interest_rate)[2] : 0 !!};
                }
            @else
                var financeRate = 5;
            @endif
            var maandBedragRente = maandBedrag + ((maandBedrag / 100) * financeRate)

            $("#leasePrice").html("&euro;" + maandBedragRente.toFixed(2))

            return maandBedragRente;
            // var total = parseFloat(maandBedragRente / looptijd).toFixed(2);
        }

        $('.form-control').on('change keyup paste', function () {
            var maandBedragRente = calculation();
            if(maandBedragRente){
                $("#leasePrice").html("&euro;" + maandBedragRente.toFixed(2))
            }else{
                console.log('empty')
            }
        });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.rawgit.com/octoshrimpy/bulma-o-steps/master/bulma-steps.css">
    <style>
        .form-group {
            margin-bottom: 0.50rem !important;
        }
        #stepsForm label {
            display: inline-block;
            margin-bottom: 0.2rem !important;
        }
        .steps{
            padding: 0 !important;
        }
        .steps-content{
            text-align: left;
            margin: 0px !important;
        }
        .steps-segment{
            list-style: none;
        }
        body {
            margin-top:40px;
        }
        .stepwizard-step p {
            margin-top: 10px;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard-step:after {
            top: 14px;
            left: 0px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 3px;
            background-color: #111;
            /*z-index: -1;*/
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
            z-index: 999;
        }
    </style>
@endpush
