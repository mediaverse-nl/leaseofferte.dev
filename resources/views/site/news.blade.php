@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('site.about') !!}">Info</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nieuws </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @include('components.info-menu')

            <div class="col-md-9" style="margin-top: -100px !important;">
                @foreach($news as $i)
                    <div class="card" style="border: none !important; background: #FFFFFF !important; margin-bottom: 30px;">
                        <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                            <div class="container">
                               <div class="row">
                                   <div class="col-md-9">
                                       <h2 class="h2" style="color:#006A8E;">{!! ucfirst($i->title) !!}</h2>
                                       {!! $i->description !!}
                                   </div>
                                   <div class="col-md-3">
                                       <div class="row">
                                           <img src="{!! $i->image !!}" alt="" style="object-fit: contain; width: 100%;">
                                       </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
