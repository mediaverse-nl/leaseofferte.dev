@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{!!  ucfirst($page->title) !!}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-12" style="margin-bottom: 150px;">

                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                        <h1 class="h1" style="color:#006A8E;">{!! $page->title !!}</h1>

                        <p>{!! $page->body !!}</p>
{{--                        {!! Editor('over_ons_paragraaf', 'richtext', false, "") !!}--}}

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
