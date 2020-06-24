<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="mediaverse.nl">

    <title>Admin panel</title>

    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/admin/sb-admin.css" rel="stylesheet">

{{-- todo remove on deployment of this website   --}}
    <meta name="robots" content="noindex" />

    <style>
        .textContainer ul{
            padding:15px !important;
        }
        body{
            font-family: 'K2D', sans-serif !important;
        }
        .breadcrumb{
            background-color: #E3E4E4 !important;
        }
        .content-wrapper{
            background: #F4F4F4 !important;
        }
        .card-header{
            background-color: #E3E4E4;
            border: none !important;
            border-radius: 0px !important;
            color: #6c757d;
        }
        .card{
            border-radius: 0px;
            border: none;
            margin-bottom: 15px !important;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.05);
        }
        ::-webkit-scrollbar {
            background-color: #F5F5F5;
            float: left;
            height: 300px;
            margin-bottom: 25px;
            margin-left: 22px;
            margin-top: 40px;
            width: 5px;
            overflow-y: scroll;
        }
        ::-webkit-scrollbar-track {
            background: #E9ECEF;
        }
        ::-webkit-scrollbar-thumb {
            background: #343A40;
        }
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9998;
            background: #FFFFFF !important;
        }
        .se-pre-con > span {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -50px 0px 0px -50px;
            height: 45px;
            width: 45px;
            z-index: 9999;
        }
        .se-pre-con > span img {
            width: 100%;
            height: auto;
        }
        input, textarea, select{
            border-radius: 0px !important;
        }

        .radio {

            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 20px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        /* Hide the browser's default radio button */
        .radio input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkround {

            position: absolute;
            top: 6px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff ;
            border-color:#f8204f;
            border-style:solid;
            border-width:2px;
            border-radius: 50%;
        }


        /* When the radio button is checked, add a blue background */
        .radio input:checked ~ .checkround {
            background-color: #fff;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkround:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .radio input:checked ~ .checkround:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .radio .checkround:after {
            left: 2px;
            top: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background:#f8204f;
        }

        /* The check */
        .check {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            padding-right: 15px;
            cursor: pointer;
            font-size: 18px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 18px;
            width: 18px;
            background-color: #fff ;
            border-color:#f8204f;
            border-style:solid;
            border-width:2px;
        }



        /* When the checkbox is checked, add a blue background */
        .check input:checked ~ .checkmark {
            background-color: #fff  ;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .check input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .check .checkmark:after {
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid ;
            border-color:#f8204f;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    <!-- Styles -->
    @stack("css")

</head>
<body class="{{Auth()->check() ? '' : 'bg-dark'}} fixed-nav sticky-footer" id="page-top">

{{--@include('components.page-loader')--}}

@if(Auth()->check())

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="">
        <a class="navbar-brand" href="{!! route('admin.dashboard') !!}">Admin Panel v2.5</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            @include('components.admin-menu-left')
            @include('components.admin-menu-top')
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container-fluid">
{{--            @include('includes.notification')--}}
            <!-- Breadcrumbs-->
            @yield('breadcrumb')

            @yield('content')
        </div>
    </div>

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Mediaverse.nl 2018</small>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
@else
    @yield('content')
@endif

<!-- Bootstrap core JavaScript-->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var LoaderElement = function(){
            $(".se-pre-con").fadeOut("slow");
        };
        $(window).on("load", function (e) {
            LoaderElement();
        });
        setInterval(function() {
            LoaderElement();
        }, 500);
    });
</script>
<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="/vendor/chart.js/Chart.min.js"></script>
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/js/admin/datatables-plugin.js"></script>
<script src="/js/admin/sb-admin.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trunk8/1.3.3/trunk8.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

<!-- Custom scripts for all pages-->
@stack("scripts")

<style>
    @page { size: auto}
</style>

</body>
</html>
