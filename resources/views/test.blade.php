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
                {{--<iframe src="https://mediaverse-dev.nl/widget" scrolling="no" type="">--}}
                <iframe
                    id="iFrame1"
                    src="https://mediaverse-dev.nl/widget?api_token=api_xxxx"
                    frameBorder="0"
                    width="100%"
                    onLoad="autoResize(this)"
                    style="height: 100%;"
                    scrolling="no">
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

@push('js')
    <script language="javaScript">
        function loadFrame(){
            console.log($(this).height($(this).contents().height()));
            // $(this).width($(this).contents().width());
        }
        function autoResize(){
            $('#iFrame1').height($('#iFrame1').contents().height());
            // loadFrame(this);
        }
    </script>
@endpush
