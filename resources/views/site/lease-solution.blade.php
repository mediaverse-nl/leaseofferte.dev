@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('site.solution.index') !!}">Lease categorieën</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{!! $solution->title !!}</li>
                </ol>
            </nav>
         </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin-bottom: 150px;">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body" style="padding: 30px;">
                        <h1 class="h1" style="color: #006A8E">{!! $solution->title !!} leasen </h1>
                        <div style="width:100%; height:400px; margin-top: 0px; overflow: hidden; background-image: url('{!! str_replace('https://mediaverse-dev.nl/', 'https://www.leaseofferte.com/', $solution->thumbnail()) !!}'); background-position: center center; background-repeat:no-repeat; background-size: contain !important;">
{{--                        <img src="{!! $solution->thumbnail() !!}" alt="" style="margin-top: 20%; width:100%;height:100%;object-fit:cover;" class="img-fluid">--}}
                        </div>

                        @include('components.collapse-text', [
                            'description' => $solution->description
                        ])

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="grid">
                    <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                        <div class="card-body" style="padding: 0px;">
                            <div style="padding: 20px;">
                                <h2 style="color: #006A8E; font-size: 32px;" class="text-center">Lease Calculator</h2>
                            </div>
                            @include('components.lease-calculator', ['preselectedObject' => $solution->category->id])
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/solution.css">
@endpush

