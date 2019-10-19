@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1 class="display-4">Lease Oplossingen</h1>
                    <p class="lead">{!! Editor('home_banner_paragraaf', 'richtext', false, '<h1 class="py-1 text-center" style="font-size: 50px !important;">This is a modified jumbotron that occupies the entire horizontal space of its parent.</h1>') !!}</p>
                    <a href="{!! route('site.solution.index') !!}" class="btn btn-default">Bereken uw lease</a>
                </div>
                <div class="col-6">
                    <div class="embed-responsive embed-responsive-16by9">

                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/k6OpkHFBhIM?loop=1&modestbranding=1" width=560 height=315 frameborder=0 allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="border: none !important; background: rgb(233, 236, 239) !important; margin-top: -60px !important;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6">
                                <h2> Lease offerte AUTO - financial lease</h2>
                                <div class="card" style="border: none !important; background: #FFFFFF !important;">
                                    <div class="card-body">

                                    </div>
                                </div>
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

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush
