<div class="container"></div>,<div class="container">

    <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Step 3</p>
            </div>
        </div>
    </div>

    <form role="form" action="" method="post">
        <div class="row setup-content" id="step-1">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3> Step 1</h3>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your address"></textarea>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3> Step 2</h3>
                    <div class="form-group">
                        <label class="control-label">Company Name</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address">
                    </div>
                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3> Step 3</h3>
                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                    <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>

</div>


@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
    <script>
        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allPrevBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                prevStepWizard.removeAttr('disabled').trigger('click');
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
    </script>
@endpush

@push('css')
<style>
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
        width: 50%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
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
    }
</style>
@endpush

{{--<ul class="nav nav-mytabs" id="myTab" role="tablist">--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link">Stap 1</a>--}}
    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link">Stap 2</a>--}}
    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link">Stap 3</a>--}}
    {{--</li>--}}
{{--</ul>--}}
{{--<div class="tab-content mytab-content" id="myTabContent">--}}
    {{--<div class="tab-pane fade show active" id="stepOne">--}}
        {{--<!-- content here -->--}}
        {{--<a class="nav-link active" data-toggle="tab" href="#stepTwo" role="tab" aria-selected="true">step 2</a>--}}
        {{--<a class="nav-link" data-toggle="tab" href="#stepTwo" role="tab" aria-selected="true">step 2</a>--}}

        {{--asdasd--}}
    {{--</div>--}}
    {{--<div class="tab-pane fade" id="stepTwo">--}}
        {{--<!-- content here -->--}}
        {{--<a class="nav-link" data-toggle="tab" href="#stepOne" role="tab" aria-selected="false">step 1</a>--}}
        {{--<a class="nav-link" data-toggle="tab" href="#stepTwo" role="tab" aria-selected="true">step 2</a>--}}
        {{--<a class="nav-link" data-toggle="tab" href="#stepThree" role="tab" aria-selected="true">step 3</a>--}}
        {{--asdasddddddd--}}
    {{--</div>--}}
    {{--<div class="tab-pane fade" id="stepThree" role="tabpanel" aria-labelledby="city-attractions-tab">--}}
        {{--<!-- content here -->--}}
        {{--vvvvvvvvvvvvvvvvvvv--}}
        {{--<a class="nav-link" data-toggle="tab" href="#stepTwo" role="tab" aria-selected="true">step 2</a>--}}

    {{--</div>--}}
{{--</div>--}}

<hr>



{{--<div id="accordion" class="leaseAccordion">--}}
    {{--<div class="card">--}}
        {{--<div class="card-header" id="headingOne">--}}
            {{--<h5 class="mb-0">--}}
                {{--<button class="btn btn-link">#1 Eerste Stap</button>--}}
            {{--</h5>--}}
        {{--</div>--}}

        {{--<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">--}}
            {{--<div class="card-body">--}}

                {{--<button class="btn btn-default" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">--}}
                    {{--volgende--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card">--}}
        {{--<div class="card-header" id="headingTwo">--}}
            {{--<h5 class="mb-0">--}}
                {{--<button class="btn btn-link">--}}
                    {{--#2 Tweede Stap--}}
                {{--</button>--}}
            {{--</h5>--}}
        {{--</div>--}}
        {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('merk', 'merk') !!}--}}
                    {{--{!! Form::text('merk', null, ['class' => 'form-control'.(!$errors->has('merk') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'merk'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('type', 'type') !!}--}}
                    {{--{!! Form::text('type', null, ['class' => 'form-control'.(!$errors->has('type') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'type'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('kenteken', 'kenteken') !!}--}}
                    {{--{!! Form::text('kenteken', null, ['class' => 'form-control'.(!$errors->has('kenteken') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'kenteken'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('kilometerstand', 'kilometerstand') !!}--}}
                    {{--{!! Form::text('kilometerstand', null, ['class' => 'form-control'.(!$errors->has('kilometerstand') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'kilometerstand'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('bouwjaar', 'bouwjaar') !!}--}}
                    {{--{!! Form::text('bouwjaar', null, ['class' => 'form-control'.(!$errors->has('bouwjaar') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'bouwjaar'])--}}
                {{--</div>--}}

                {{--<button class="btn btn-default" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
                    {{--vorige--}}
                {{--</button>--}}

                {{--<button class="btn btn-default" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">--}}
                    {{--volgende--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card">--}}
        {{--<div class="card-header" id="headingThree">--}}
            {{--<h5 class="mb-0">--}}
                {{--<button class="btn btn-link collapsed">--}}
                    {{--#3 Laatste Stap--}}
                {{--</button>--}}
            {{--</h5>--}}
        {{--</div>--}}
        {{--<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('volledige_naam', 'voor- en achternaam') !!}--}}
                    {{--{!! Form::text('volledige_naam', null, ['class' => 'form-control'.(!$errors->has('volledige_naam') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'volledige_naam'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('geboortedatum', 'geboortedatum (dd-mm-jjjj)') !!}--}}
                    {{--{!! Form::text('geboortedatum', null, ['class' => 'form-control'.(!$errors->has('geboortedatum') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'geboortedatum'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('bedrijfsnaam', 'bedrijfsnaam') !!}--}}
                    {{--{!! Form::text('bedrijfsnaam', null, ['class' => 'form-control'.(!$errors->has('bedrijfsnaam') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'bedrijfsnaam'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('kvk', 'kvk') !!}--}}
                    {{--{!! Form::text('kvk', null, ['class' => 'form-control'.(!$errors->has('kvk') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'kvk'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('adres', 'adres') !!}--}}
                    {{--{!! Form::text('adres', null, ['class' => 'form-control'.(!$errors->has('adres') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'adres'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('postcode', 'postcode') !!}--}}
                    {{--{!! Form::text('postcode', null, ['class' => 'form-control'.(!$errors->has('postcode') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'postcode'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('plaats', 'plaats') !!}--}}
                    {{--{!! Form::text('plaats', null, ['class' => 'form-control'.(!$errors->has('plaats') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'plaats'])--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('email', 'email') !!}--}}
                    {{--{!! Form::text('email', null, ['class' => 'form-control'.(!$errors->has('email') ? '': ' is-invalid ')]) !!}--}}
                    {{--@include('components.error', ['field' => 'email'])--}}
                {{--</div>--}}

                {{--<button class="btn btn-default" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">--}}
                    {{--vorige--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}