@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <div class="row" style="padding: 30px 0px 100px 0px;">
                <div class="col-md-6">
{{--                    <h1 class="display-4" style="font-size: 32px;">Lease uw auto's of bedrijfsmiddelen bij LEASEOFFERTE.com</h1>--}}
{{--                    <br>--}}
{{--                    <br>--}}
{{--                    <p class="lead">--}}
{{--                        ✔ Scherpe tarieven ✔ Goede voorwaarde ✔ Persoonlijke service--}}
{{--                        <br>--}}
{{--                        <br>--}}
{{--                        Dien uw aanvraag in en ontvang van ons de beste lease overeenkomst in de markt.--}}
{{--                        <br>--}}
{{--                        <br>--}}
                        {!! Editor('home_banner_paragraaf', 'richtext', false, "") !!}
{{--                    </p>--}}
                    <a href="#test" id="test" class=" scrollTo btn btn-default btn-block" style="border-radius: 4px; padding: 10px; font-size: 18px">Bereken uw lease prijs</a>
                    <br>
                    <br>
                </div>
                <div class="col-md-6">
                    <div class="embed-responsive embed-responsive-16by9">

                        <video class="embed-responsive-item" poster="/img/video-thumbnail.jpg" width="320" height="240" controls controlsList="nodownload">

                            <source src="/video/LEASEOFFERTE.com - FINANCIAL LEASE.mp4" type="video/mp4">
                            <source src="/video/LEASEOFFERTE.com - FINANCIAL LEASE.mp4" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
            </div>


            <a id="stepsForm"> </a>
            <br>
            <br>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -160px !important;">
                    <div class="card-body" style="padding: 30px;">
{{--                        <h2 class="h2" style="color: #006A8E;">Lease Calculator</h2>--}}
                        <div class="row">
                            <div class="col-md-6">

{{--                                <p>Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt, en wat het optimale lease tarief en de optimale voorwaarden zijn.</p>--}}

                                @component('components.lease-calculator')
                                @endcomponent
                                <br>
                            </div>
                            <div class="col-md-6">

                                @component('components.info-checker')
                                @endcomponent

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #leaseForm{
            color: #6c757d;
        }
    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush
