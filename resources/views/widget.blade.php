<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="copyright" content="Leaseofferte.com - All rights reserved">
    <meta name="author" content="Lease Offerte">

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
    </style>

    @stack("css")

</head>
<body>
    <div class="container">
        <div class="row">
            @include('components.lease-calculator')

        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"  ></script>

    @stack("js")

</body>
</html>


