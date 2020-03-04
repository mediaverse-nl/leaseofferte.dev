<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="copyright" content="Leaseofferte.com - All rights reserved">
    <meta name="author" content="Lease Offerte">

    {!! SEO::generate() !!}

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Light&display=swap" rel="stylesheet">--}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .form-control{
            border-color: #D9E9EE;
            border-radius: 4px;
        }
        .btn.dropdown-toggle.btn-light{
            border-color: #D9E9EE !important;
        }
        .slick-slide {
            outline: none
        }
        .btn-default{
            background: #f78e0c !important;
            color: #FFFFFF;
        }
        .btn{
            border-radius: 4px !important;
        }
        .breadcrumb{
            background: none;
        }
        .jumbotron{
            /*margin-bottom: 0px !important;*/
        }
        .nav-item a{
            /*color: black !important;*/
        }
        .note-editable {
            /*font-family: 'Roboto Light', sans-serif !important;*/
        }
        a {
            color: inherit;
            text-decoration: none;
            background-color: transparent;
        }
        html,
        body {
            background: #F1F7F9 !important;
            height: 100%;
            font-style: inherit;
            font-family: "Roboto Light", sans-serif;
        }
        #page-content {
            flex: 1 0 auto;
        }
        .card-header{
            background: #006A8E;
        }
        .card-header, .card-header button{
            color: #FFFFFF;
        }
        .card-header button:hover{
            color: #FFFFFF;
        }
        .leaseAccordion .card-body{
            background: #F1F7F9;
        }

        .breadcrumb-item a,
        .breadcrumb-item.active{
            color: #F1F7F9 !important;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            display: inline-block;
            padding-right: 0.5rem;
            color: #F1F7F9;
            content: "/";
        }
        .main-menu-top .nav-item a{
            color: #000000 !important;
            font-size: 16px;
            text-transform: uppercase;
            /*font-weight: bold;*/
        }

        .nav-item.active > .nav-link{
            border-radius: 4px;
            background: #006486;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }
        .nav-item.active a{
            color: white !important;
        }

        .cookie-consent {
            position: fixed;
            bottom: 0px;
            left: 0;
            right: 0;
            width: 100%;
            padding: 30px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            /*border-radius: 5px;*/
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .js-cookie-consent-agree {
            display: block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            padding: 10px;
            background: #f78e0c !important;
            color: #FFFFFF;
        }

        footer .light a,
        footer .light h5{
            color: #ffffff;
        }

        footer .blue a,
        footer .footer-copyright,
        footer .blue i,
        footer .blue h5{
            color: #006A8E;
        }
    </style>

    {{--    @if(Auth::check() && Auth::user()->admin == 1)--}}
    @if(Auth::check())
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
        <style>
            .note-air-popover{
                /*background-color: #e83e8c;*/
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
<body class="d-flex flex-column" id="app">
    <div id="page-content">
        @include('includes.header')

        <main style="margin-top: 20px;">
            @yield('content')
        </main>
    </div>

    @include('includes.footer')

    @include('cookieConsent::index')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"  ></script>

    @if(Auth::check())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    @endif

    @stack("js")

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/bindings/inputmask.binding.min.js"></script>
    <script language="javascript" type="text/javascript">

        $(".moneyFormat").inputmask({
            radixPoint:",",
            // mask: "99999999",
            clearMaskOnLostFocus: "false",
            autoUnmask:true,
            unmaskAsNumber:true,
            alias:"currency",
            // groupSeparator:".",
            // autoGroup:true,
            // digits:2,
            // integerDigits: 8,
            prefix:"\u20ac ",
            rightAlign:false,
            removeMaskOnSubmit:true,
            clearIncomplete: true
        });

        $('.scrollTo').click(function() {
            var sectionTo = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top
            }, 1500);
        });

        $(document).ready(function () {
            setInterval(keepTokenAlive, 1000 * 60 * 1); // every 15 mins

            function keepTokenAlive() {
                $.ajax({
                    url: '/refresh-csrf',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function (res) {
                    $('meta[name="csrf-token"]').attr('content', res);
                });
            };
        });
    </script>
</body>
</html>
