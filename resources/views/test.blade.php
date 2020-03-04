@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Info </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
{{--                <iframe src="https://mediaverse-dev.nl/widget" scrolling="no" type="">--}}
                <iframe src="https://mediaverse-dev.nl/widget" frameBorder="0" width="100%" height="600" scrolling="no">
                    <p>Your browser does not support iframes.</p>
                </iframe>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
    </style>
@endpush

@push('scripts')
    <script>

    </script>
@endpush
