@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('site.about') !!}">Info</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{!!  ucfirst($page->title) !!}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="row">

            @include('components.info-menu')

            <div class="col-md-9" style="margin-bottom: 150px;">

                 <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                        {!! str_replace('https://mediaverse-dev.nl/', '/', $page->body) !!}
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('css')
<style>
    h1, h2{
        color: #006A8E !important;
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
