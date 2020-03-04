@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('site.autolease') !!}">Autolease</a></li>
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
            <div class="col-md-12 col-lg-8" style="margin-bottom:120px;">
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
                        <div style="padding: 25px;" class="{!! isset($offer->images) ? (count(explode(',', $offer->images)) == 1 ? 'd-none' : '') : null !!}">
                            <div class="slider-nav">
                                @if(isset($offer->images))
                                    @foreach(explode(',', $offer->images) as $img)
                                         <img src="{!! $img !!}" alt="" class="img-fluid">
                                    @endforeach
                                @endif
                             </div>
                        </div>

                        @include('components.collapse-text', [
                            'description' => $offer->description
                        ])

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 ">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body" style="color: #6F777A !important; padding: 30px;">
                        @include('components.success-order-model')

                        <h1 class="h1" style="color: #006A8E">{!! $offer->merk !!}</h1>

                        <table >
                            @foreach($offer->operationalLeasePrices as $i)
                                <tr style="font-size: 0.9rem;">
                                    <td class="text-right">{!! $i->km_per_jaar !!} km </td>
                                    <td><small class="text-right" style="padding: 3px;">|</small> {!! $i->looptijd !!} mnd</td>
                                    <td id="bedrag3">
                                        <small class="text-right" style="padding: 3px;">|</small>
                                        <span style="font-size: 105%; color: #f78e0c;">
                                            <b>€ {!! $i->leaseprijs_per_maand  !!} p.m.</b>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
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

                        {!! Form::open(['route' => 'site.calculator.operational', 'id' => 'previousForm', 'enctype="multipart/form-data"']) !!}
                            {!! Form::hidden('operational_id', $offer->id) !!}
                            <h3 class="h5">Vraag uw lease offerte aan</h3>
                            <div class="form-group">
                                <div class="input-icon">
                                    {!! Form::text('jaarkilometrage', null, ['placeholder' => 'jaarkilometrage *', 'class' => 'withIcon form-control'.(!$errors->has('jaarkilometrage') ? '': ' is-invalid '),'id' => 'jaarkilometrage']) !!}
                                    <i>km</i>
                                </div>
                                @include('components.error', ['field' => 'jaarkilometrage'])
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
                                @include('components.error', ['field' => 'looptijd'])
                            </div>

                            <div class="form-group">
                                {!! Form::select('winterbanden', [
                                     'ja' => 'ja',
                                     'nee' => 'nee',
                                ], null, [
                                     'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('winterbanden') ? '': ' show-error-line').'"',
                                     'placeholder' => '--- met winterbanden * ---',
                                     'class' => 'selectpicker form-control'.(!$errors->has('winterbanden') ? '': ' is-invalid '),
                                     'id' => 'winterbanden'
                                ]) !!}
                                @include('components.error', ['field' => 'winterbanden'])

                            </div>
                            <div class="form-group">
                                {!! Form::select('vervangend_vervoer', [
                                 'ja' => 'ja',
                                 'nee' => 'nee',
                                 ], null, [
                                     'data-style="btn dropdown-toggle btn-light bs-placeholder'.(!$errors->has('vervangend_vervoer') ? '': ' show-error-line').'"',
                                     'placeholder' => '--- Vervangend vervoer na 24 uur bij schade of onderhoud * ---',
                                     'class' => 'selectpicker form-control'.(!$errors->has('vervangend_vervoer') ? '': ' is-invalid '),
                                     'id' => 'vervangend_vervoer'
                                 ]) !!}
                                @include('components.error', ['field' => 'vervangend_vervoer'])
                            </div>
                        <br>
                            <h3 class="h5">Uw gegevens</h3>
                            <div class="form-group">
                                {!! Form::text('voornaam_en_achternaam', null, ['placeholder' => 'Voor- en achternaam *', 'class' => 'withIcon form-control'.(!$errors->has('voornaam_en_achternaam') ? '': ' is-invalid '),'id' => 'voornaam_en_achternaam']) !!}
                                @include('components.error', ['field' => 'voornaam_en_achternaam'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('bedrijfsnaam', null, ['placeholder' => 'Bedrijfsnaam *', 'class' => 'withIcon form-control'.(!$errors->has('bedrijfsnaam') ? '': ' is-invalid '),'id' => 'bedrijfsnaam']) !!}
                                @include('components.error', ['field' => 'bedrijfsnaam'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('kvk_nummer', null, ['placeholder' => 'K.v.k. nummer *', 'class' => 'withIcon form-control'.(!$errors->has('kvk_nummer') ? '': ' is-invalid '),'id' => 'kvk_nummer']) !!}
                                @include('components.error', ['field' => 'kvk_nummer'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('adres', null, ['placeholder' => 'Adres *', 'class' => 'withIcon form-control'.(!$errors->has('adres') ? '': ' is-invalid '),'id' => 'adres']) !!}
                                @include('components.error', ['field' => 'adres'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('postcode', null, ['placeholder' => 'Postcode *', 'class' => 'withIcon form-control'.(!$errors->has('postcode') ? '': ' is-invalid '),'id' => 'postcode']) !!}
                                @include('components.error', ['field' => 'postcode'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('plaats', null, ['placeholder' => 'Plaats *', 'class' => 'withIcon form-control'.(!$errors->has('plaats') ? '': ' is-invalid '),'id' => 'plaats']) !!}
                                @include('components.error', ['field' => 'plaats'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('email', null, ['placeholder' => 'E-mailadres *', 'class' => 'withIcon form-control'.(!$errors->has('email') ? '': ' is-invalid '),'id' => 'email']) !!}
                                @include('components.error', ['field' => 'email'])
                            </div>
                            <div class="form-group">
                                {!! Form::text('telefoonnummer', null, ['placeholder' => 'Telefoonnummer *', 'class' => 'withIcon form-control'.(!$errors->has('telefoonnummer') ? '': ' is-invalid '),'id' => 'telefoonnummer']) !!}
                                @include('components.error', ['field' => 'telefoonnummer'])
                            </div>
                            <div class="form-group">
                                <div class="input-group mt-3" >
                                    <div class="custom-file" style="border-color: #D9E9EE !important;">
                                        <input id="inputGroupFile02" type="file" multiple class="custom-file-input {!! (!$errors->has('bestanden') ? '': ' is-invalid ') !!}" name="bestanden[]">
                                        <label class="custom-file-label" for="inputGroupFile02">Upload hier uw offerte</label>
                                    </div>
                                </div>
                                @include('components.error', ['field' => 'bestanden'])
                            </div>
                        <br>


                        {!! NoCaptcha::display() !!}

                        @if($errors->has('g-recaptcha-response'))
                            <div style="margin-top: -15px !important;">
                                @include('components.error', ['field' => 'g-recaptcha-response'])
                            </div>
                            <br>
                        @endif


                        <button class="btn btn-default btn-block">Aanvraag versturen</button>

                        <small class="text-muted">Alle velden met een * zijn verplicht</small>
                        <br>
                        <br>

                        {!! Form::close() !!}

                        {!! Editor('usp_paragraaf_2', 'richtext', false, "✔ Wij gaan direct uw offerte maken.") !!}

                     </div>
                </div>

                <br>
                <br>
                <br>
            </div>

        </div>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
       .custom-file-label{
            overflow: hidden;
        }
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
        .slick-track img{
            padding: 20px;
            /*height: ;*/
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
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
@endpush
