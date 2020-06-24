@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <div class="row" style="padding: 30px 0px 100px 0px;">
                <div class="col-md-6">
                        {!! Editor('home_banner_paragraaf', 'richtext', false, "") !!}
                    <a href="#scrollToForm" id="scrollToForm" class="scrollTo btn btn-default btn-block" style="border-radius: 4px; padding: 10px; font-size: 18px">Bereken uw leaseprijs</a>
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
                        <div class="row">
                            <div class="col-md-6">
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
        <br>
        <br>
        <br>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/home.css">
@endpush

