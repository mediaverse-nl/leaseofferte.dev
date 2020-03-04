@extends('layouts.app')

@section('content')
    @php
        $colors = [];
        foreach ($baseOffers->groupBy('kleur')->orderBy('kleur')->get()->pluck('kleur') as $i){
            foreach (explode(',', $i) as $c){
                $colors[] = $c;
            }
        }
        $colors = array_unique($colors);
        sort($colors);

        $brands = $baseOffers->groupBy('merk')->orderBy('merk')->get()->pluck('merk');
        $types = $baseOffers->groupBy('type')->orderBy('type')->get()->pluck('type');

        $maxPrice = \App\OperationalLeasePrice::max('leaseprijs_per_maand');
        $minPrice = \App\OperationalLeasePrice::min('leaseprijs_per_maand');

    @endphp
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('site.autolease') !!}">Autolease</a></li>
                    <li class="breadcrumb-item active">Lease operational</li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 50px 0px;">
                <div class="col-12">
                    <h1 class="display-4">Operational Lease Aanbod</h1>
                    <br>
                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="card" style="margin-bottom:50px; overflow: hidden; border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body">
                        <h1 style="color: #006A8E;">Filter</h1>
                        {!! Form::open(['route' => ['site.offer.index'], 'method' => 'get', 'id' => 'filterForm']) !!}

                        <hr>
                        <span class="font-weight-bold" style="color: #006A8E;">Lease prijs per maand</span>
                        <div>
                            <input type="hidden"
                               id="priceRange"
                               name="priceRange"
                               data-provide="slider"
                               data-slider-min="{!! round($minPrice, 0) > 0 ? round($minPrice, 0) : 1 !!}"
                               data-slider-max="{!! round($maxPrice, 0) !!}"
                               data-slider-step="1"
                               data-slider-value="[{!! isset($filter['priceRange']) ? $filter['priceRange'] : $minPrice.",".$maxPrice!!}]"/>
                        </div>
                        <div class="row">
                            <div class="pull-left col-md-6">&euro; <span id="minPrice">{!! $minPrice !!}</span></div>
                            <div class="pull-right col-md-6 text-right" style="width: 50%;display: block;">&euro; <span id="maxPrice">{!! $maxPrice !!}</span></div>
                        </div>
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Auto segment</span>
                        @foreach($baseOffers->segment() as $i)
                            <label class="checkbox"> {!! $i !!}
                                <input type="checkbox" name="auto_segment[]" value="{!! $i !!}"
                                    {!! !empty($filter['auto_segment']) ? (in_array($i, $filter['auto_segment']) ? 'checked' : '') : '' !!}>
                                <span class="checkmark checkbox-square"></span>
                            </label>
                        @endforeach
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Auto merken</span>
                        <ul class="checkboxes {{count($brands) > 5 ? '' : 'active'}}" id="brandChecks" style="height: 165px; list-style: none; margin-bottom: 0px; padding: 0px !important;">
                            @foreach($brands as $brand)
                                <li>
                                    <label for="brands{!! $brand !!}" class="checkboxLabel checkbox" style="">
                                        {{$brand}}
                                        <input type="checkbox" id="brands{!! $brand !!}" name="brands[]" value="{!! $brand !!}"
                                            {!! !empty($filter['brands']) ? (in_array($brand, $filter['brands']) ? 'checked' : '') : '' !!}>
                                        <span class="checkmark checkbox-square"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        @if(count($brands) > 5)
                            <div class="show_more" data-id="brandChecks">
                                <b><span>+</span> laat meer zien</b>
                            </div>
                        @endif
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Model/Type</span>
                        <ul class="checkboxes {{count($types) > 5 ? '' : 'active'}}" id="ModelChecks" style="height: 165px; list-style: none; margin-bottom: 0px; padding: 0px !important;">
                            @foreach($types as $type)
                                <li>
                                    <label for="types{!! $type !!}" class="checkboxLabel checkbox" style="text-transform:capitalize;">
                                        {{$type}}
                                        <input type="checkbox" id="types{!! $type !!}" name="types[]" value="{!! $type !!}"
                                            {!! !empty($filter['types']) ? (in_array($type, $filter['types']) ? 'checked' : '') : '' !!}>
                                        <span class="checkmark checkbox-square"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        @if(count($types) > 5)
                            <div class="show_more" data-id="ModelChecks">
                                <b><span>+</span> laat meer zien</b>
                            </div>
                        @endif
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Brandstof </span>
                        <ul class="checkboxes" id="fuelChecks" style="list-style: none; margin-bottom: 0px; padding: 0px !important;">
                            @foreach($baseOffers->fuels() as $i)
                                <li>
                                    <label class="checkbox"> {!! $i !!}
                                        <input id="fuel" type="checkbox" name="fuel[]" value="{!! $i !!}"
                                            {!! !empty($filter['fuel']) ? (in_array($i, $filter['fuel']) ? 'checked' : '') : '' !!}>
                                        <span class="checkmark checkbox-square"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="show_more" data-id="fuelChecks">
                            <b><span>+</span> laat meer zien</b>
                        </div>
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Carrosserie</span>
                        <ul class="checkboxes" id="carrosserieChecks" style="list-style: none; margin-bottom: 0px; padding: 0px !important;">
                            @foreach($baseOffers->carrosserie() as $i)
                                <li>
                                    <label class="checkbox"> {!! $i !!}
                                        <input type="checkbox" name="carrosserie[]" value="{!! $i !!}"
                                            {!! !empty($filter['carrosserie']) ? (in_array($i, $filter['carrosserie']) ? 'checked' : '') : '' !!}>
                                        <span class="checkmark checkbox-square"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="show_more" data-id="carrosserieChecks">
                            <b><span>+</span> laat meer zien</b>
                        </div>
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Aantal deuren</span>
                        @foreach($baseOffers->amountOfDoors() as $i)
                            <label class="checkbox"> {!! $i !!}
                                <input type="checkbox" name="amountOfDoors[]" value="{!! $i !!}"
                                    {!! !empty($filter['amountOfDoors']) ? (in_array($i, $filter['amountOfDoors']) ? 'checked' : '') : '' !!}>
                                <span class="checkmark checkbox-square"></span>
                            </label>
                        @endforeach
                        <hr >

                        <span class="font-weight-bold" style="color: #006A8E;">Kleuren</span>
                        <ul class="checkboxes {{count($colors) > 5 ? '' : 'active'}}" id="colorChecks" style="list-style: none; margin-bottom: 0px; padding: 0px !important;">
                            @foreach($colors as $color)
                                <li>
                                    <label for="color{!! $color !!}" class="checkboxLabel checkbox" style="text-transform:capitalize;">
                                        {{$color}}
                                        <input type="checkbox" id="color{!! $color !!}" name="color[]" value="{!! $color !!}"
                                            {!! !empty($filter['color']) ? (in_array($color, $filter['color']) ? 'checked' : '') : '' !!}>
                                        <span class="checkmark checkbox-square"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        @if(count($colors) > 5)
                            <div class="show_more" data-id="colorChecks">
                                <b><span>+</span> laat meer zien</b>
                            </div>
                        @endif
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" style="margin-bottom:50px; overflow: hidden; border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body">
                        <div class="grid">
                            @foreach($offers as $offer)
                                <div class="grid-item category-{!!  $offer->id !!}" style="padding: 10px;" onmouseover='$("#content-{!! $offer->id !!}").show();' onmouseout='$("#content-{!! $offer->id !!}").hide();'>
                                    <a href="{!! route('site.offer.show', [$offer->urlTitle, $offer->id]) !!}" style="text-decoration: none;">
                                        <div style="background-image: url('{!! $offer->thumbnail() !!}'); height: 100%; background-position: center center; background-repeat:no-repeat; background-size: contain !important;"></div>

                                        <span style="margin-left: -10px;">
                                    <div class="" id="content-{!! $offer->id !!}" style='margin-top: -25px; width:100%;display:none; background: #009FD6;'>
                                        <p class="text-center font-weight-bold" style=" border: none; color: #FFFFFF;text-transform: uppercase; padding: 15px;" >bereken uw lease</p>
                                    </div>
                                    <h2 style=" font-size: 14px; padding: 15px 0px; margin-top: -25px; background: #fff; bottom: 0px;" class="text-center font-weight-bold">
                                        {!! $offer->title !!}
                                    </h2>
                                </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.1/css/bootstrap-slider.min.css">
    <style>
        .show_more{
            color: #006A8E;
            font-size: 12px;
        }
        .checkboxes.active {
            height: auto !important;
        }
        .checkboxes {
            height: 100px;
            overflow: hidden;
        }
        .slider.slider-horizontal .slider-track {
            height: 5px;
            margin-top: -3px;
        }
        .slider-selection{
            background-color: #009FD6 !important;
            background-image: none !important;
        }

        .slider-handle{
            background-color: #009FD6 !important;
            background-image: none !important;
        }
        .slider.slider-horizontal{
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
        }

        /*// Extra small devices (portrait phones, less than 576px)*/
        @media (max-width: 575.98px) {
            .grid-item {
                width: 100%;
                border: 1px solid gray;
                height: 200px;
            }
        }

        /*// Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) and (max-width: 767.98px) {
            .grid-item {
                width: 33.33%;
                border: 1px solid gray;
                height: 200px;
            }
        }

        /*// Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) and (max-width: 991.98px) {
            .grid-item {
                width: 25%;
                border: 1px solid gray;
                height: 200px;
            }
        }

        /*// Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .grid-item {
                width: 25%;
                border: 1px solid gray;
                height: 200px;
            }
        }

        /*// Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            .grid-item {
                width: 25%;
                border: 1px solid gray;
                height: 200px;
            }
        }
        .grid-item span{
            position: absolute;
            bottom: 0;
            width: 100%;
            margin: 0 auto;
        }
        .grid-item{
            overflow: hidden;
            background-position: center center;
            background-size: cover !important;
            border: 1px solid transparent !important;
            padding-bottom: 20px;
        }
        .grid-item:hover{
            border-radius: 4px;
            border: 1px solid #D9E9EE !important;
        }
        .grid-item--width2 {
            width: 50%;
        }
        #stepsForm{
            margin-top: 0px !important;
            border-radius: 0px !important;
            border: none !important;
        }
        #stepsForm .card-header{
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 0px !important;
            border-radius: 0px !important;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        .jumbotron {
            background-color: #009FD6;
            background-size: cover;
            background-position: center center;
            border-radius: 0px;
            color: #FFFFFF;
        }
        .img-thumbnail{
            border: none !important;
        }
        .card-header{
            border-radius: 0px !important;
        }
        /* Hide the browser's default checkbox */
        .checkbox {
            color: #000;
            /*color: #009FD6;*/
            display: block;
            padding-top: 3px;
            position: relative;
            padding-left: 35px;
            /*margin-bottom: 12px;*/
            cursor: pointer;
            font-size: 14px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default radio button */
        .checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom radio button */
        .checkmark {
            /*margin-top: 5px;*/
            position: absolute;
            margin-top: 4px;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border-radius: 50%;
        }

        .checkbox-square {
        /*    !*margin-top: 5px;*!*/
        /*    position: absolute;*/
        /*    margin-top: 4px;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    height: 20px;*/
        /*    width: 20px;*/
        /*    background-color: #eee;*/
            border-radius: 0% !important;
        }

        /* On mouse-over, add a grey background color */
        .checkbox:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .checkbox input:checked ~ .checkmark {
            background-color: #009FD6;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.1/bootstrap-slider.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>
        $(document).ready(function(){

            function priceRange(value){
                var val = value.split(",");
                var minPrice = val[0];
                var maxPrice = val[1];
                $("#maxPrice").html(maxPrice);
                $("#minPrice").html(minPrice);
            }
            priceRange($('#priceRange').val());

            $('#priceRange').bind('change', function() {
                priceRange($('#priceRange').val());
            });

            var timer;
            function intervalTimer() {
                if (timer) clearInterval(timer);
                timer = setInterval(function() {
                    clearInterval(timer);
                    submitForm();
                }, 1500);
            }
            function submitForm(){
                $( "#filterForm" ).submit();
            }
            $('#datetimepicker1').change(function() {
                intervalTimer();
            });

            $('#filterForm').change(function() {
                intervalTimer();
            });

            var allRadios = document.getElementById('fuel');
            var booRadio;
            var x = 0;
            for(x = 0; x < allRadios.length; x++){
                allRadios[x].onclick = function() {
                    if(booRadio == this){
                        this.checked = false;
                        booRadio = null;
                    } else {
                        booRadio = this;
                    }
                };
            }
            // store filter for each group
            var buttonFilters = {};
            var buttonFilter;
            // quick search regex
            var qsRegex;

            // init Isotope
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                layoutMode: 'fitRows',
                animationOptions: {
                    duration: 750,
                    easing: 'easein',
                    queue: true
                },
                getSortData: {
                    name: '.name',
                    symbol: '.symbol',
                    number: '.number parseInt',
                    category: '[data-category]',
                    weight: function( itemElem ) {
                        var weight = $( itemElem ).find('.weight').text();
                        return parseFloat( weight.replace( /[\(\)]/g, '') );
                    }
                },
                filter: function() {
                    var $this = $(this);
                    var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
                    var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
                    return searchResult && buttonResult;
                }
            });

            // bind filter on radio button click
            $('#filters').on('click', 'input', function() {
                // get filter value from input value
                var $this = $(this);
                var $buttonGroup = $this.parents('.button-group');
                var filterGroup = $buttonGroup.attr('data-filter-group');
                // set filter for group
                buttonFilters[ filterGroup ] = this.value;
                // combine filters
                buttonFilter = concatValues( buttonFilters );
                // Isotope arrange
                $grid.isotope();
            });

            // change is-checked class on buttons
            $('.button-group').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });

            // debounce so filtering doesn't happen every millisecond
            function debounce( fn, threshold ) {
                var timeout;
                threshold = threshold || 100;
                return function debounced() {
                    clearTimeout( timeout );
                    var args = arguments;
                    var _this = this;
                    function delayed() {
                        fn.apply( _this, args );
                    }
                    timeout = setTimeout( delayed, threshold );
                };
            }

            // flatten object by concatting values
            function concatValues( obj ) {
                var value = '';
                for ( var prop in obj ) {
                    value += obj[ prop ];
                }
                return value;
            }

            if($('.checkboxes li').length)
            {
                var boxes = $('.checkboxes li');

                boxes.each(function()
                {
                    var box = $(this);

                    box.on('click', function()
                    {
                        if(box.hasClass('active'))
                        {
                            box.find('i').removeClass('fa-square');
                            box.find('i').addClass('fa-square-o');
                            box.toggleClass('active');
                        }
                        else
                        {
                            box.find('i').removeClass('fa-square-o');
                            box.find('i').addClass('fa-square');
                            box.toggleClass('active');
                        }
                        // box.toggleClass('active');
                    });
                });

                if($('.show_more').length)
                {
                    $('.show_more').on('click', function(e)
                    {
                        var checkboxes = $('.checkboxes#'+this.getAttribute('data-id'));
                        var checkboxesActive = $('.checkboxes.active#'+this.getAttribute('data-id'));

                        var contentName = $(this);

                        if(checkboxesActive.length >= 1){
                            contentName.html('<b><span>+</span> laat meer zien</b>')
                        }else {
                            contentName.html('<b><span>-</span> laat minder zien</b>')
                        }

                        checkboxes.toggleClass('active');
                    });
                }
            };
        });
    </script>
@endpush
