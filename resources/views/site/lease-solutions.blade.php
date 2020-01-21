@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active">  Lease oplossingen </li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 100px 0px;">
                <div class="col-12">
                    <h1 class="display-4">Lease Oplossingen</h1>
                    <br>
                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>
                    <br>
                    <div id="cover">
                        <div class="td" style="width:90%;">
                            <input type="text" placeholder="ZOEK HIER OP TREFWOORD" class="quicksearch" required>
                        </div>
                        <div class="td" id="s-cover">
                            <i class="fa fa-search float-right" ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important; margin-bottom: 120px !important;">
                    <div class="card-body">
                        <div id="filters" class="button-group" data-filter-group="choices">

                            <h1 style="color: #006A8E;">Categorie</h1>

                            <label class="checkbox">Toon alle lease oplossingen
                                <input type="radio" name="option" value="*" checked="checked">
                                <span class="checkmark"></span>
                            </label>

                            @foreach($categories as $category)
                                <label class="checkbox">
                                    {!! $category->value !!}
                                    <input type="radio" name="option" value=".category-{!! $category->id !!}" >
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="card" style="overflow: hidden; border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body">
                        <div class="grid">
                            @foreach($solutions as $solution)
                                <div class="grid-item category-{!! $solution->category_id !!}" style="padding: 10px;" onmouseover='$("#content-{!! $solution->id !!}").show();' onmouseout='$("#content-{!! $solution->id !!}").hide();'>
                                    <a href="{!! route('site.solution.show', [$solution->urlTitle, $solution->id]) !!}" style="text-decoration: none;">
                                        <div style="background-image: url('{!! $solution->thumbnail() !!}'); height: 100%; background-position: center center; background-repeat:no-repeat; background-size: contain !important;">

                                        </div>

                                        <span style="margin-left: -10px;">
                                            <div class="" id="content-{!! $solution->id !!}" style='margin-top: -25px; width:100%;display:none; background: #009FD6;'>
                                                <p class="text-center font-weight-bold" style=" border: none; color: #FFFFFF;text-transform: uppercase; padding: 15px;" >bereken uw lease</p>
                                            </div>
                                            <h2 style=" font-size: 14px; padding: 15px 0px; margin-top: -25px; background: #fff; bottom: 0px;" class="text-center font-weight-bold">
                                                {!! $solution->title !!}
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
    <style>
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
                width: 33.33%;
                border: 1px solid gray;
                height: 200px;
            }
        }

        /*// Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .grid-item {
                width: 33.33%;
                border: 1px solid gray;
                height: 250px;
            }
        }

        /*// Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            .grid-item {
                width: 33.33%;
                border: 1px solid gray;
                height: 250px;
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
    </style>
    <style>

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

    <style>
        *{
            outline: none !important;
        }

        input, button
        {
            color: #fff;
            padding: 0;
            margin: 0;
            border: 0;
            background-color: transparent;
        }
        .td{
            display: inline-block;
        }

        #cover
        {
            border-bottom: 1px solid #FFFFFF;
            /*position: absolute;*/
            opacity: 0.7;
            padding-bottom: 5px;
            left: 0;
            right: 0;
            width: 100%;
        }
        #s-cover{
            width: 10%;
            font-size:20px;
            float: right;
        }

        input[type="text"]
        {
            width: 100%;
            font-size:20px;
            line-height: 1;
        }

        input[type="text"]::placeholder
        {
            color: #FFF;
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>
        $(document).ready(function(){
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

            $('#filters input').each(function() {
                if($(this).is(':checked') && $(this).val() != "*"){
                    var $this = $(this);
                    var $buttonGroup = $this.parents('.button-group');
                    var filterGroup = $buttonGroup.attr('data-filter-group');
                    // set filter for group
                    buttonFilters[ filterGroup ] = this.value;
                    // combine filters
                    buttonFilter = concatValues( buttonFilters );
                    // Isotope arrange
                    $grid.isotope();
                }
            })

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

            // use value of search field to filter
            var $quicksearch = $('.quicksearch').keyup( debounce( function() {
                qsRegex = new RegExp( $quicksearch.val(), 'gi' );
                $grid.isotope();
            }, 200 ) );

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

        });
    </script>
@endpush
