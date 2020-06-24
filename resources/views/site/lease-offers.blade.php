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
                    <li class="breadcrumb-item active">Operational lease </li>
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

                        <span class="font-weight-bold" style="color: #006A8E;">Auto merk</span>
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

                        <span class="font-weight-bold" style="color: #006A8E;">Transmissie</span>
                        @foreach($baseOffers->transmission() as $i)
                            <label class="checkbox"> {!! $i !!}
                                <input type="checkbox" name="transmission[]" value="{!! $i !!}"
                                    {!! !empty($filter['transmission']) ? (in_array($i, $filter['transmission']) ? 'checked' : '') : '' !!}>
                                <span class="checkmark checkbox-square"></span>
                            </label>
                        @endforeach
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
                                        <div role="img" aria-label="{!! $offer->title !!}" style="background-image: url('{!! str_replace('https://mediaverse-dev.nl/', '/', $offer->thumbnail()) !!}'); height: 100%; background-position: center center; background-repeat:no-repeat; background-size: contain !important;"></div>

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
    <link rel="stylesheet" href="/css/lease-offers.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.1/bootstrap-slider.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="/js/lease-offers.js"></script>
@endpush
