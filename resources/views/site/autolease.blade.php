@extends('layouts.app')

@section('content')
{{--    <div class="jumbotron" style="height: 220px;">--}}
{{--        <div class="container">--}}
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">--}}
{{--                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page">Autolease </li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--            <div class="row" style="padding: 30px 0px 50px 0px;">--}}
{{--                <div class="col-12">--}}
{{--                    <h1 class="display-4">Operational Lease aanbod</h1>--}}
{{--                    <br>--}}
{{--                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Autolease </li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 50px 0px;">
                <div class="col-12">
                    <h1 class="display-4">Auto leasen?</h1>
                    <br>
                    <p class="lead">Bekijk hier welke aanbod voor u het beste is.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card" style="border: none !important; background: #FFFFFF !important; margin-bottom: 120px; margin-top: -100px !important;">
                            <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                                {!! Editor('autolease_paragraaf', 'richtext', false, "") !!}
                                <br>
                                <a class="btn btn-default btn-lg btn-block" style="color: white;" href="{!! route('site.offer.index') !!}">
                                    Ga naar operational lease aanbod
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                            <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                                {!! Editor('autolease_paragraaf_2', 'richtext', false, "") !!}
                                <br>
                                <a class="btn btn-default btn-lg btn-block" style="color: white;" href="{!! route('site.cartel.index') !!}">
                                    Ga naar financial lease aanbod
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                <br>
            </div>
        </div>
    </div>

    @include('components.portfolio-banner')
@endsection

@push('css')
    <style>
        .jumbotron {
            background-color: #009FD6;
            background-size: cover;
            background-position: center center;
            border-radius: 0px;
            color: #FFFFFF;
        }
    </style>
@endpush
