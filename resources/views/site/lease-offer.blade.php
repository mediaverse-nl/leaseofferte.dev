@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{!! route('site.offer.index') !!}">Lease operational</a> </li>
                    <li class="breadcrumb-item active">{!! $offer->title !!}</li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 50px 0px;">
                <div class="col-12">
                    <h1 class="display-4">Operational Lease aanbod</h1>
                    <br>
                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin-bottom:120px;">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body" style="padding: 30px;">
                        <h1 class="h1" style="color: #006A8E">{!! $offer->merk !!} {!! $offer->type !!}</h1>
                        <h2 class="h5" style="color: #006A8E">{!! $offer->uitvoering !!}</h2>

                        <div class="slider-for">
                            @if(isset($offer->images))
                                @foreach(explode(',', $offer->images) as $img)
                                    <img src="{!! $img !!}" alt="" class="img-fluid">
                                @endforeach
                            @endif
                         </div>
                        <hr >
                        <div style="padding: 25px;">
                            <div class="slider-nav">
                                @if(isset($offer->images))
                                    @foreach(explode(',', $offer->images) as $img)
                                         <img src="{!! $img !!}" alt="" class="img-fluid">
                                    @endforeach
                                @endif
                             </div>
                        </div>

                        {!! $offer->description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body" style="padding: 30px;">
                        <h1 class="h1" style="color: #006A8E">{!! $offer->merk !!}</h1>

                        <table >
                            <tr>
                                <td  >{!! $offer->kilometrage !!} km <span style="padding: 3px;">|</span> </td>
                                <td>{!! explode(',', $offer->looptijd)[2] !!} mnd <span style="padding: 3px;">|</span> </td>
                                <td id="bedrag3">
                                    <span style="font-size: 105%; color: #f78e0c;">
                                        <b>€ {!! getLeasePrice($offer->catalogusprijs, explode(',', $offer->looptijd)[2]) !!} per maand</b>
                                    </span>
                                </td>                            </tr>
                            <tr>
                                <td>{!! $offer->kilometrage !!} km <span style="padding: 3px;">|</span> </td>
                                <td>{!! explode(',', $offer->looptijd)[1] !!} mnd <span style="padding: 3px;">|</span>  </td>
                                <td id="bedrag2">
                                    <span style="font-size: 105%; color: #f78e0c;">
                                        <b>€ {!! getLeasePrice($offer->catalogusprijs, explode(',', $offer->looptijd)[1]) !!} per maand</b>
                                    </span>
                                </td>                            </tr>
                            <tr>
                                <td>{!! $offer->kilometrage !!} km <span style="padding: 3px;">|</span>  </td>
                                <td>{!! explode(',', $offer->looptijd)[0] !!} mnd <span style="padding: 3px;">|</span>  </td>
                                <td id="bedrag1">
                                    <span style="font-size: 105%; color: #f78e0c;">
                                        <b>€ {!! getLeasePrice($offer->catalogusprijs, explode(',', $offer->looptijd)[0]) !!} per maand</b>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <small class="text-muted">Prijzen onder voorbehoud *</small>

                        <br>
                        <br>

                        <table cellpadding="">
                            <tr>
                                <td><b style="padding-right: 5px;">Catalogusprijs:</b> </td>
                                <td>&euro; {!! number_format($offer->catalogusprijs) !!}</td>
                            </tr>
                            <tr>
                                <td><b>Bijtelling:</b></td>
                                <td>{!! ( $offer->bijtelling) !!}%</td>
                            </tr>
                        </table>

                        <br>
                        {!! Editor('usp_paragraaf', 'richtext', false, "asdasdas") !!}

                        {!! Form::open(['route' => 'site.calculator.formStep', 'id' => 'previousForm', 'enctype="multipart/form-data"']) !!}
                            <h3 class="h5">Vraag uw lease offerte aan</h3>
                            <div class="form-group">
                                <div class="input-icon">
                                    {!! Form::text('jaarkilometrage', null, ['placeholder' => 'jaarkilometrage *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                                    <i>km</i>
                                </div>
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
                             ], null, [
                                 'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('looptijd') ? '': ' show-error-line').'"',
                                 'placeholder' => '--- looptijd * ---',
                                 'class' => 'selectpicker form-control'.(!$errors->has('looptijd') ? '': ' is-invalid '),
                                 'id' => 'looptijd'
                             ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::select('looptijd', [
                                 'ja' => 'ja',
                                 'nee' => 'nee',
                             ], null, [
                                 'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('looptijd') ? '': ' show-error-line').'"',
                                 'placeholder' => '--- met winterbanden * ---',
                                 'class' => 'selectpicker form-control'.(!$errors->has('looptijd') ? '': ' is-invalid '),
                                 'id' => 'looptijd'
                             ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::select('looptijd', [
                                 'ja' => 'ja',
                                 'nee' => 'nee',
                                 ], null, [
                                     'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('looptijd') ? '': ' show-error-line').'"',
                                     'placeholder' => '--- Vervangend vervoer na 24 uur bij schade of onderhoud * ---',
                                     'class' => 'selectpicker form-control'.(!$errors->has('looptijd') ? '': ' is-invalid '),
                                     'id' => 'looptijd'
                                 ]) !!}
                            </div>

                            <h3 class="h5">Uw gegevens</h3>
                            <div class="form-group">
                                {!! Form::text('voornaam_en_achternaam', null, ['placeholder' => 'Voor- en achternaam *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('bedrijfsnaam', null, ['placeholder' => 'Bedrijfsnaam *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('kvk_nummer', null, ['placeholder' => 'K.v.k. nummer *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('adres', null, ['placeholder' => 'Adres *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('postcode', null, ['placeholder' => 'Postcode *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('plaats', null, ['placeholder' => 'Plaats *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('email', null, ['placeholder' => 'E-mailadres *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('telefoonnummer', null, ['placeholder' => 'Telefoonnummer *', 'class' => 'withIcon form-control'.(!$errors->has('aanbetaling') ? '': ' is-invalid '),'id' => 'aanbetaling']) !!}
                            </div>
                            <div class="form-group">
                                <div class="input-group mt-3">
                                    <div class="custom-file">
                                        <input id="inputGroupFile02" type="file" multiple class="custom-file-input">
                                        <label class="custom-file-label" for="inputGroupFile02">Upload hier uw offerte</label>
                                    </div>
                                </div>
                            </div>
                        <br>


                        {!! NoCaptcha::display() !!}
                        @include('components.error', ['field' => 'g-recaptcha-response'])

                        <small class="text-muted">Alle velden met een * zijn verplicht</small>

                        <button class="btn btn-default btn-block">Aanvraag versturen</button>
                            <br>

                         {!! Form::close() !!}



                        {!! Editor('usp_paragraaf_2', 'richtext', false, "✔ Wij gaan direct uw offerte maken.") !!}

                     </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        .form-group {
            margin-bottom: 0.5em !important;
        }

        .g-recaptcha {
            transform:scale(0.77);
            -webkit-transform:scale(0.77);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;
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
            width: 40px;
            text-align: center;
            font-style: normal;
        }

        .input-icon > input {
            padding-left: 40px;
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

        .slick-arrow:before{
            color: black !important;
            opacity: .3;
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
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        $(document).ready(function () {

            bsCustomFileInput.init()
        })
    </script>
    {!! NoCaptcha::renderJs() !!}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            arrows: true,
            centerMode: true,
            focusOnSelect: true
        });
    </script>
@endpush
