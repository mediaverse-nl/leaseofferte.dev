@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.static-solution.create') !!}
@endsection

@section('content')

    @php
        $types = \App\LeaseOffer::orderBy('type')->pluck('type');
        $brands = \App\LeaseOffer::orderBy('merk')->pluck('merk');
        $colors = [];

        foreach (\App\LeaseOffer::pluck('kleur') as $c){
            foreach (explode(',', $c) as $i){
                $colors[] = $i;
            }
        }
        rsort($colors);
    @endphp
    {!! Form::open(['route' => ['admin.static-solution.store'], 'method' => 'POST', 'autocomplete="off"']) !!}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                            'id' => 'CreateCategory',
                            'title' => 'Edit entry ',
                            'actionRoute' => route('admin.static-solution.store'),
                            'btnClass' => 'btn btn-warning',
                            'btnIcon' => null,
                            'btnTitle' => 'edit',
                        ])
                        @slot('description')
                            If u proceed u will <b>edit</b> this entry
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>

        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h2>algemene informatie</h2>
                    <div class="form-group">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'title'])
                    </div>

                    @include('components.color-samples')

                    <div class="form-group">
                        {!! Form::label('description', 'description') !!}
                        {!! Form::textarea('description', null, ['class' => 'summernote form-control'.(!$errors->has('description') ? '': ' is-invalid '), 'rows' => '8']) !!}
                        @include('components.error', ['field' => 'description'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('uitvoering', 'uitvoering') !!}
                        {!! Form::text('uitvoering', null, ['class' => 'form-control'.(!$errors->has('uitvoering') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'uitvoering'])
                    </div>

{{--                    <div class="form-group">--}}
{{--                        {!! Form::label('inbegrepen', 'inbegrepen') !!}--}}
{{--                        {!! Form::text('inbegrepen', null, ['class' => 'form-control'.(!$errors->has('inbegrepen') ? '': ' is-invalid ')]) !!}--}}
{{--                        @include('components.error', ['field' => 'inbegrepen'])--}}
{{--                    </div>--}}

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('catalogusprijs', 'catalogusprijs') !!}
                                {!! Form::text('catalogusprijs', null, ['class' => 'form-control'.(!$errors->has('catalogusprijs') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'catalogusprijs'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('bijtelling', 'bijtelling') !!}
                                {!! Form::text('bijtelling', null, ['class' => 'form-control'.(!$errors->has('bijtelling') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'bijtelling'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('number_of_doors', 'number_of_doors') !!}
                                {!! Form::select('number_of_doors', array_combine(\App\LeaseOffer::amountOfDoors(), \App\LeaseOffer::amountOfDoors()), null, ['placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('number_of_doors') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'number_of_doors'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('auto_segment', 'auto_segment') !!}
                                {!! Form::select('auto_segment', array_combine(\App\LeaseOffer::segment(), \App\LeaseOffer::segment()), null, ['placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('auto_segment') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'auto_segment'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('carrosserie', 'carrosserie') !!}
                                {!! Form::select('carrosserie', array_combine(\App\LeaseOffer::carrosserie(), \App\LeaseOffer::carrosserie()), null, ['placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('carrosserie') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'carrosserie'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('type', 'type') !!}
                                {!! Form::text('type', null, ['id="types"', 'placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('type') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'type'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('fuel', 'fuel') !!}
                                {!! Form::select('fuel', array_combine(\App\LeaseOffer::fuels(), \App\LeaseOffer::fuels()), null, ['placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('fuel') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'fuel'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('merk', 'merk') !!}
                                {!! Form::text('merk', null, ['id="brand"', 'placeholder="-- select --"', 'class' => 'form-control'.(!$errors->has('merk') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'merk'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>(SEO) search engine optimalisation</h2>

                    <div class="form-group">
                        {!! Form::label('meta_title', 'meta_title') !!}
                        {!! Form::text('meta_title', null, ['class' => 'form-control'.(!$errors->has('meta_title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'meta_title'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_description', 'meta_description') !!}
                        {!! Form::textarea('meta_description', null, ['class' => 'form-control'.(!$errors->has('meta_description') ? '': ' is-invalid '), 'rows' => '3']) !!}
                        @include('components.error', ['field' => 'meta_description'])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h2>afbeeldingen</h2>
                    <div class="form-group">
                        <label for="">Images</label>
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="productThumbnail" data-preview="imgHolder" class="btn btn-primary text-white" style="border-radius: 0px !important;">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            <input id="productThumbnail" class="form-control" type="text" disabled
                                   value=" ">
                            {!! Form::hidden('images', null, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}
                        </div>

                        @include('components.error', ['field' => 'images'])

                        <div id="imgHolder" style="margin-top:15px;height:auto;">
                        </div>

                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>lease condities</h2>

                    <table class="table table-bordered table-striped" id="FinancialDataTable">
                        <thead>
                        <tr>
                            <th style="width:20%">looptijd</th>
                            <th style="width:40%">km per jaar</th>
                            <th style="width:40%">leaseprijs p.m.</th>
                            <th style=""></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(request()->old('lease_conditions'))
                            @foreach(request()->old('lease_conditions') as $k => $v)
                                <tr>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::select('lease_conditions['.$k.'][looptijd]',
                                                array_combine([12,18,24,30,36,42,48,54,60,72,84], [12,18,24,30,36,42,48,54,60,72,84]),
                                                null, ['class' => 'looptijd form-control'.(!$errors->has('lease_conditions.'.$k.'.looptijd') ? '': ' is-invalid ')]) !!}
                                            @include('components.error', ['field' => 'lease_conditions.'.$k.'.looptijd'])
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::text('lease_conditions['.$k.'][km_per_jaar]',  null, ['class' => 'km_per_jaar form-control'.(!$errors->has('lease_conditions.'.$k.'.km_per_jaar') ? '': ' is-invalid ')]) !!}
                                            @include('components.error', ['field' => 'lease_conditions.'.$k.'.km_per_jaar'])
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::text('lease_conditions['.$k.'][leaseprijs_per_maand]', null, ['class' => 'leaseprijs_per_maand form-control'.(!$errors->has('lease_conditions.'.$k.'.leaseprijs_per_maand') ? '': ' is-invalid ')]) !!}
                                            @include('components.error', ['field' => 'lease_conditions.'.$k.'.leaseprijs_per_maand'])
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @if($solution->operationalLeasePrices()->count() > 0)
                                @foreach($solution->operationalLeasePrices as $k => $v)
                                    <tr>
                                        <td>
                                            <div class="form-group" style="margin: 0px !important;">
                                                {!! Form::select('lease_conditions['.$k.'][looptijd]',
                                                    array_combine([12,18,24,30,36,42,48,54,60,72,84], [12,18,24,30,36,42,48,54,60,72,84]),
                                                    $v->looptijd, ['class' => 'looptijd form-control']) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin: 0px !important;">
                                                {!! Form::text('lease_conditions['.$k.'][km_per_jaar]', $v->km_per_jaar, ['class' => 'km_per_jaar form-control']) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin: 0px !important;">
                                                {!! Form::text('lease_conditions['.$k.'][leaseprijs_per_maand]', $v->leaseprijs_per_maand, ['class' => 'leaseprijs_per_maand form-control']) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="margin: 0px !important;">
                                                <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                test
                                <tr>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::select('lease_conditions[0][looptijd]',
                                                array_combine([12,18,24,30,36,42,48,54,60,72,84], [12,18,24,30,36,42,48,54,60,72,84]),
                                                null, ['class' => 'looptijd form-control']) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::text('lease_conditions[0][km_per_jaar]',  null, ['class' => 'km_per_jaar form-control']) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            {!! Form::text('lease_conditions[0][leaseprijs_per_maand]', null, ['class' => 'leaseprijs_per_maand form-control']) !!}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group" style="margin: 0px !important;">
                                            <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endif

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary btn-sm" id="btn-clone">Add New Condition</button>

                    <hr>
                </div>
            </div><div class="card">
                <div class="card-body">
                    <h2>Car colors</h2>

                    <table class="table table-bordered table-striped" id="colorDataTable">
                        <tbody>
                        @if(request()->old('kleur'))
                            @foreach(request()->old('kleur') as $k => $v)
                                <tr>
                                    <td style="width: 100%;">
                                        <div class="form-group" style="margin-bottom: 0px !important;">
                                            {!! Form::text('kleur[]', $v, ['id="color"', 'placeholder="-- select --"', 'class' => 'color form-control'.(!$errors->has('kleur.'.$k) ? '': ' is-invalid ')]) !!}
                                            @include('components.error', ['field' => 'kleur.'.$k])
                                        </div>
                                    </td>
                                    <td style="width: 20px;">
                                        <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <div class="form-group" style="margin-bottom: 0px !important;">
                                        {!! Form::text('kleur[]', null, ['id="color"', 'placeholder="-- select --"', 'class' => 'color form-control']) !!}
                                    </div>
                                </td>
                                <td style="width: 20px;">
                                    <button type="button" class="btn btn-danger btn-sm" id="DeleteButton">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @include('components.error', ['field' => 'kleur'])
                    @if($errors->has('kleur'))
                        <br>
                    @endif

                    <button type="button" class="btn btn-primary btn-sm" id="btn-clone-color">Add New Color</button>

                    <hr>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <style>
        .autocomplete-items {
            /*position: absolute;*/
            border: 1px solid #ced4da;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }
        .autocomplete-items div {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }
        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #fff;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>

        $('#btn-clone').click(function () {
            $('#FinancialDataTable tbody').append($('#FinancialDataTable tbody tr:last').clone());
            $('#FinancialDataTable tr').each(function (i) {
                i = i -1;
                var looptijd = $(this).find('.looptijd');
                var km_per_jaar = $(this).find('.km_per_jaar');
                var leaseprijs_per_maand = $(this).find('.leaseprijs_per_maand');
                looptijd.eq(0).attr('name', 'lease_conditions['+ i +'][looptijd]');
                km_per_jaar.eq(0).attr('name', 'lease_conditions['+ i +'][km_per_jaar]');
                leaseprijs_per_maand.eq(0).attr('name', 'lease_conditions['+ i +'][leaseprijs_per_maand]');
            });
            $('#FinancialDataTable tr:last .leaseprijs_per_maand ').val(null);
            $('#FinancialDataTable tr:last .km_per_jaar').val(null);
            $('#FinancialDataTable tr:last .looptijd').val(null);
            $('#FinancialDataTable tr:last #DeleteButton').removeClass('d-none');
            buttonStatus(this);
        });

        $('#btn-clone-color').click(function () {
            $('#colorDataTable tbody').append($('#colorDataTable tbody tr:last').clone());
            $('#colorDataTable tr').each(function (i) {
                var color_input = $(this).find('.color_input');
                color_input.eq(0).attr('name', 'kleur[]');
            });
            $('#colorDataTable tr:last #color').val(null);
            $('#colorDataTable tr:last #DeleteButton').removeClass('d-none');
            buttonStatus(this);
            appendAutoCompleet();
        });

        $("#FinancialDataTable, #colorDataTable").on("click", "#DeleteButton", function() {
            buttonStatus(this);
        });

        function buttonStatus(el) {
            $(el).closest("tr").remove();
            if($('#FinancialDataTable tbody tr').length == 1){
                $('#FinancialDataTable tbody tr #DeleteButton:first').addClass('d-none')
            }else {
                $('#FinancialDataTable tbody tr #DeleteButton:first').removeClass('d-none')
            }
            if($('#colorDataTable tbody tr').length == 1){
                $('#colorDataTable tbody tr #DeleteButton:first').addClass('d-none')
            }else {
                $('#colorDataTable tbody tr #DeleteButton:first').removeClass('d-none')
            }
        }

        appendAutoCompleet();
        function appendAutoCompleet() {
            $(".color").each(function( index ) {
                autocomplete(this, {!! json_encode($colors) !!});
            });
            autocomplete(document.getElementById("brand"), {!! $brands !!});
            autocomplete(document.getElementById("types"), {!! $types !!});
        }

        $('#selectpicker').selectpicker();

        var route_prefix = "{!! route('unisharp.lfm.show') !!}";

        $('#lfm').filemanager('file', {prefix: route_prefix});

        function getImagePath(el) {
            $('#productThumbnailCopy').val(el);
        }

        getImagePath($('#productThumbnail').val());

        $('#productThumbnail').change(function() {
            getImagePath($(this).val());
        });

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });
            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }
            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });
        }
    </script>
@endpush
