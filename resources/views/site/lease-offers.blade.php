@extends('layouts.app')

@section('content')
{{--    <div class="jumbotron" style="height: 220px;">--}}
{{--        <div class="container">--}}
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">--}}
{{--                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>--}}
{{--                    <li class="breadcrumb-item active"><a href="{!! route('site.solution.index') !!}">Lease aanbiedingen</a></li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--         </div>--}}
{{--    </div>--}}

    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="https://mediaverse-dev.nl">Home</a></li>
                    <li class="breadcrumb-item active">  Lease operational </li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 50px 0px;">
                <div class="col-12">
                    <h1 class="display-4">Lease Operational</h1>
                    <br>
                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>

                </div>
            </div>
        </div>
    </div>

    <div class="container">

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
{{--                        <div class="grid-item category-{!! $offer->id !!}" style="padding: 10px;" >--}}
{{--                            <a href="{!! route('site.offer.show', [$offer->urlTitle, $offer->id]) !!}">--}}
{{--                                <div style="background-image: url('{!! $offer->thumbnail() !!}'); height: 100%; background-position: center center; background-size: cover !important;"></div>--}}
{{--                                <span>--}}
{{--                                    <h2 style="font-size: 14px; padding: 7px 0px; margin-top: -25px; background: #fff; bottom: 0px;" class="text-center">{!! $offer->title !!}</h2>--}}
{{--                                     <h2 style="font-size: 14px; padding: 7px 0px; margin-top: -25px; background: #fff; bottom: 0px;" class="text-center">{!! $offer->cate !!}</h2>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    @endforeach
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

        });
    </script>
@endpush
