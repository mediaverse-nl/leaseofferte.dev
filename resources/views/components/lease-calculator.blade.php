
@php
    if (session('formSteps') === null){
        session(['formSteps' => 1]);
    }

    if (!empty(session('formFields'))){
        $fields = (object)decrypt(session('formFields'));
    }else{
        $fields = (object)[];
    }

    $solutions = (new \App\Solution())->orderBy('title', 'asc')->get();

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

            @include('components.success-order-model')

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
                                'placeholder' => 'aanschafprijs *',
                                'class' => 'moneyFormat withIcon form-control'.(!$errors->has('aanschaf') ? '': ' is-invalid '),
                                'id' => 'aanschaf'
                            ]) !!}
                            @include('components.error', ['field' => 'aanschaf'])
                        </div>

                        <div class="form-group">
                            {!! Form::text('aanbetaling', null, [
                                'placeholder' => 'aanbetaling ',
                                'class' => 'moneyFormat withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),
                                'id' => 'aanbetaling'
                            ]) !!}

                            @include('components.error', ['field' => 'aanbetaling'])
                        </div>

                        <div class="form-group">
                            {!! Form::text('slottermijn', null, [
                                'placeholder' => 'slottermijn ',
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
{{--                        {!! request('id') !!}--}}

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
                                        @endphp
                                        @switch($f->field_type)
                                            @case('text')
                                                {!! Form::text(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('textarea')
                                                {!! Form::textarea(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                            @break
                                            @case('number')
                                                {!! Form::number(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
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
                                    @endphp
                                    @switch($f->field_type)
                                        @case('text')
                                            {!! Form::text(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('textarea')
                                            {!! Form::textarea(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'rows="4"', 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
                                        @break
                                        @case('number')
                                            {!! Form::number(StripReplace($f->field_name), null, ['placeholder' => ucfirst($f->field_name)." ".$fieldRequired, 'class' => 'form-control'.(!$errors->has(StripReplace($f->field_name)) ? '': ' is-invalid '),'id' => StripReplace($f->field_name)]) !!}
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
                    <br>
                    <div data-toggle="modal" data-target="#checker" data-placement="top" style="display: inline-block;" class="btn btn-lg btn-back ">
                        <a class="" data-toggle="tooltip" data-placement="top" title="{!! '' or '' !!}" style="color: #006A8E;">
                            <i class="fa fa-info-circle" style="color: #006A8E;"></i>
                            controleer uw gegevens
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="checker" tabindex="-1" role="dialog" aria-labelledby="checkerLabel" aria-hidden="true">
                        <div class="modal-dialog mo dal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="checkerLabel"> controleer uw gegevens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="overflow: hidden !important;">
                                    @component('components.info-checker', ['edit' => true])
                                    @endcomponent
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="border-radius: 0px;" data-dismiss="modal">Terug</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                    {!! Editor('calculator_bericht', 'richtext', false, "uw formulier is verzonden..") !!}
{{--                    <br>--}}
{{--                    <br>--}}
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

{{--        <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(2)'>vorige</a>--}}

    </div>

</div>

@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script language="javascript" type="text/javascript">

        function submitForm(step) {
            $("#to-previous").val(step);

            $("#previousForm").submit();
        }

        calculation();

        function calculation()
        {
            var aanschaf = parseFloat($("#aanschaf").val())
            var aanbetaling = parseFloat($("#aanbetaling").val())
            var slottermijn = parseFloat($("#slottermijn").val())
            var looptijd = parseFloat($("#looptijd").val().substr(0, 2));
            var obj = $('#object option:selected').val()

            if(!$("#aanbetaling").val()){
                aanbetaling = 0
            }
            if(!$("#slottermijn").val()){
                slottermijn = 0
            }

            var total = (aanschaf - aanbetaling - slottermijn);

            if((total || total === 0)
                && (obj || obj === 0)
                && (looptijd || looptijd === 0)) {
                $.ajax({
                    url: "/api/calculator-rates-"+obj
                            +"?aanschaf="+aanschaf
                            +"&aanbetaling="+aanbetaling
                            +"&slottermijn="+slottermijn
                            +"&looptijd="+looptijd,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $(".leasePrice").html("&euro; " + res['leasePrice']);
                    }
                });
            }
        }

        $('.form-control').on('change keyup paste', function () {
            calculation();
        });
    </script>
@endpush

@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/octoshrimpy/bulma-o-steps/master/bulma-steps.css">
    <style>
        .modal-body .card-header{
            margin: 0px !important;
        }
        .input-icon {
            position: relative;
        }

        .input-icon > i {
            color: #6c757d;
            position: absolute;
            display: block;
            transform: translate(0, -50%);
            top: 50%;
            pointer-events: none;
            width: 25px;
            text-align: center;
            font-style: normal;
        }

        .input-icon > input {
            padding-left: 25px;
            padding-right: 0;
        }

        .input-icon-right > i {
            right: 0;
        }

        .input-icon-right > input {
            padding-left: 0;
            padding-right: 25px;
            text-align: right;
        }
        .btn-light.show-error-line{
            border-color: #e3342f !important;
            background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem) !important;
        }

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
            margin: 0px;
        }
        .iconRow > div{
            margin: 0px !important;
            /*display: table-cell;*/
            padding: 0px;
            height: 55px;
            vertical-align: middle;
            text-align:center;
        }

        .iconRow img{
            display:block;
            height: 100% !important;
            padding: 5px;
            /*width: 100%;*/
            display: block;
            margin-left: auto;
            margin-right: auto;
             /*background: black;*/
        }
        .btn-orange{
            background: #f78e0c !important;
            color: white;
        }
        .btn-back{
            background: #F0F6F9  !important;
        }
        .iconRow div i {
            text-align:center;
        }

        .btn-light:not(:disabled):not(.disabled):active, .btn-light:not(:disabled):not(.disabled).active, .show > .btn-light.dropdown-toggle {
            color: #495057 !important;
            background-color: #fff !important;
            border-color: #ced4da !important;
        }

        .btn-light {
            color: #495057 !important;
            background-color: #fff !important;
            border-color: #ced4da !important;
            border-radius: 0.25rem !important;
        }

        .steps.is-hollow .steps-marker, .steps-marker.is-hollow {
            border: 1px solid !important;
        }
        .steps.is-horizontal .steps-segment:not(:last-child):after {
            height: 1px !important;
        }

        .steps.is-horizontal{
            margin-top: 6px;
        }
        .form-control,
        .filter-option-inner-inner,
        .bootstrap-select .dropdown-menu li a {
            color: #6c757d;
        }
        .form-control{
            color: #6c757d;
        }
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
