
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

        //dd($category);
        //dd($category = $solutions->find($solutionID)->category);
    }elseif(isset($small)){

        $category = $solutions->find(request('id'))->category;;
        //dd($category);
    }

    //if (isset($small)){
    //    $solutionID = isset($small) ? request('id') : $fields->object;
    //    $solutions = $solutions->find($solutionID)->category->solutions;
     //   $category = $solutions->find($solutionID)->category;
        //todo hier moet aanpassening gemaakt worden
        //add preselected sub category
    //}

    $solutions = $solutions->pluck('title', 'id');
@endphp

<div class="card" style="background: #f78e0c !important; margin-top: 0px;" id="stepsForm">
{{--<div class="card" style="margin-top: 60px;" id="stepsForm">--}}
    <div class="card-header" style="background: #ffffff !important; {!! isset($preselectedObject) ? 'border-radius: 4px !important;' : null !!}; height: 90px; ">
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
    <div class="card-body" style="background: #f78e0c !important;">
        <div class="leaseAccordion">

            @include('components.success-order-model')

            @if(isset($small) ? ( $small == true ) : false)
                <p style="color: #000; font-weight: 600;" class="text-center h3">Uw Leasebedrag per maand <b style="color:#ffffff;" id="leasePrice" class="leasePrice">&euro; 0</b></p>
            @endif

            {!! Form::model((session('formFields') !== null ? decrypt(session('formFields')) : []), ['route' => 'site.calculator.store']) !!}
                <div class="row setup-content {!! (session('formSteps') != 1) ? 'd-none' : '' !!}" id="step-1">
                    <div class="col-md-12">
                        <br>
                        <div class="form-group">
                            {!! Form::select('object', $solutions, isset($small) && !isset($fields->object) ? request('id') : null , [
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

                        <small class="text-muted" style="color: #333333 !important;"> Alle velden met een * zijn verplicht.</small>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-lg btn-block pull-right" style="color: #fff; background: #7FAF1B;" type="submit">volgende stap</button>
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
                                            //$fieldRequired = "*";
                                            $fieldRequired = isset($f->field_validation) ? (str_contains($f->field_validation, "required") ?  "*": "") : "";
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
                            <small class="text-muted" style="color: #333333 !important;"> Alle velden met een * zijn verplicht.</small>
                            <br>
                            <br>
                            <div class="row" >
                                <div class="col-6">
                                    <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(1)'>vorige</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn- btn-lg btn-block pull-right" style="color: #fff; background: #7FAF1B;" type="submit">verder</button>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

            <br>
                <div class="row setup-content {!! (session('formSteps') != 3) ? 'd-none' : '' !!}" id="step-3">
                    <div class="col-md-12">
                        @if(isset($category))
                            @foreach($category->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get() as $f)
                                <div class="form-group">
                                    @php
                                        $fieldRequired = isset($f->field_validation) ? (str_contains($f->field_validation, "required") ?  "*": "") : "";
                                        //$fieldRequired = str_contains($f->field_validation, "required") ?  "*": "";
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

                        <small class="text-muted" style="color: #333333 !important;"> Alle velden met een * zijn verplicht.</small>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-back nextBtn btn-lg btn-block pull-left" onClick='submitForm(2)'>vorige</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-lg btn-block pull-right" style="color: #fff; background: #7FAF1B;" type="submit">afronden</button>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('formSteps') == 4)
                    <br>
                    <div data-toggle="modal" data-target="#checker" data-placement="top" style="display: inline-block;" class="btn btn-lg btn-back ">
                        <a class="" data-toggle="tooltip" data-placement="top" title="{!! '' or '' !!}" style="color: #333333;">
                            <i class="fa fa-info-circle" style="color: #333;"></i>
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
                    <button class="btn btn btn-lg btn-block pull-right" style="color: #ffffff; background: #7FAF1B !important;" type="submit">
                        <i class="fas fa- fa-envelope" style="color: #ffffff;"></i>
                        verzenden
                    </button>
                    <br>
                    <div class="form-group">
                        <small style="color: #333333;">Door verder te gaan bevestig je akkoord te gaan met de
                            <a href="{!! route('site.terms') !!}">algemene voorwaarden</a>.
                        </small>
                    </div>
                @endif
            {!! Form::close() !!}
        </div>
        {!! Form::open(['route' => 'site.calculator.formStep', 'id' => 'previousForm']) !!}
            <input type='hidden' id="to-previous" name="step" />
        {!! Form::close() !!}
        <br>
        <div class="container no-gutters pt-2">
            <div class="row ">
                <div class="col-5" style="padding: 0px !important;">
                    @include('components.profile-img-slider')
                </div>
                <div class="col">
                    {!! Editor('contactgegevens_klein', 'richtext', false, null) !!}
                </div>
            </div>
        </div>

    </div>
</div>


@push('js')
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
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/octoshrimpy/bulma-o-steps/master/bulma-steps.min.css">
    <link rel="stylesheet" href="/css/calculator.css">
    <style>
        .leaseAccordion .text-danger{
            color: #333333 !important;
        }
    </style>
@endpush
