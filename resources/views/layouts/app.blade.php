<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .btn-default{
            background: #EF9627 !important;
            color: #FFFFFF;
        }
        .btn{
            border-radius: 0px;
        }
    </style>

{{--    @if(Auth::check() && Auth::user()->admin == 1)--}}
    @if(Auth::check())
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
        <style>
            .note-air-popover{
                background-color: #e83e8c;
                width: 380px;
                max-width: 380px;
                min-width: 200px;
                border-radius: 0px !important;
            }
            .popover-content.note-children-container{
                background-color: #cecece;
                color: #eeeeee;
            }
            input[type="button"]
            {
                width:120px;
                height:60px;
                margin-left:35px;
                display:block;
                background-color:gray;
                color:white;
                border: none;
                outline:none;
            }
        </style>
    @endif


    @stack("css")

</head>
<body>
    <div id="app">

        @include('includes.header')

        <main class="py-4">
            @yield('content')
        </main>

        @include('includes.footer')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"  ></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}

{{--    @if(Auth::check() && Auth::user()->admin == 1)--}}
    @if(Auth::check())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    @endif

    @stack("js")
</body>
</html>
