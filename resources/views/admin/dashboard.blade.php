@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.dashboard') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <div class="mr-5">{!! \App\User::count() !!} - users</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href=" ">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-barcode"></i>
                    </div>
                    <div class="mr-5">  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route('admin.category.index') !!}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-white o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">{!! \App\Category::count()!!} - categories </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route('admin.category.index') !!}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning-orange o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-file"></i>
                    </div>
                    <div class="mr-5">File manager</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route('admin.file-manager.index') !!}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-question"></i>
                    </div>
                    <div class="mr-5">F.A.Q. items</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{!! route('admin.faq.index') !!}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Orders
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div id="mysecondchart" class="chartjs-render-monitor" style="height: 250px;"></div>
                    </div>
                </div>
                {{--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Registered Users
                </div>
                <div class="card-body">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                {{--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Order Methods
                </div>
                <div class="card-body chartjs-size-monitor">
                    <div id="donutExample" style="height: 250px;"></div>
                </div>
             </div>
        </div>
    </div>

@endsection

@push('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- Custom styles for this template-->
<link href="/css/admin/sb-admin.css" rel="stylesheet">
    <style>
        .bg-white{
            background-color: #4a2bff !important;
        }
        .bg-warning-orange{
            background-color: #ff8e1b !important;
        }
    </style>
@endpush

@push('scripts')
 {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>--}}
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
{{--<script src="/vendor/chart.js/Chart.min.js"></script>--}}

<script>

    {{--@php--}}
        {{--$func = function($array) {--}}
            {{--$arr = [];--}}
            {{--if (isset($array))--}}
                {{--foreach ($array as $key => $value){--}}
                    {{--if ($key == 'year' || $key == 'month' || $key == 'paid'){--}}
                        {{--if ($key == 'paid'){--}}
                            {{--$arr[$key] = number_format(($array[$key]), 0);--}}
                        {{--}else{--}}
                            {{--$arr[$key] = strval($array[$key]);--}}
                        {{--}--}}
                    {{--}else{--}}
                        {{--$arr[$key] = $array[$key];--}}
                    {{--}--}}
                {{--}--}}
                {{--return $arr;--}}
        {{--};--}}

        {{--$orderLineData = array_map($func, \App\Order::select(--}}
            {{--DB::raw('count(id) as `count`'),--}}
            {{--DB::raw('SUM(total_paid) as `paid`'),--}}
            {{--DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') new_date"),--}}
            {{--DB::raw('YEAR(created_at) year, MONTH(created_at) month')--}}
        {{--)--}}
        {{--->groupby('year', 'month')--}}
        {{--->get()--}}
        {{--->toArray());--}}

        {{--$userLineData = array_map($func, \App\User::select(--}}
            {{--DB::raw('count(id) as `count`'),--}}
            {{--DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') new_date"),--}}
            {{--DB::raw('YEAR(created_at) year, MONTH(created_at) month')--}}
        {{--)--}}
        {{--->groupby('year', 'month')--}}
        {{--->get()--}}
        {{--->toArray());--}}

        {{--$orderDonutData = array_map($func, \App\Order::where('payment_method', '!=', 'null')--}}
        {{--->select(--}}
            {{--DB::raw('count(payment_method) as `count`')--}}
        {{--)--}}
        {{--->groupby('payment_method')--}}
        {{--->get()--}}
        {{--->toArray());--}}

    {{--@endphp--}}

    {{--var orderLineData = {!! collect($orderLineData)->toJson() !!};--}}

    {{--var userLineData = {!! collect($userLineData)->toJson() !!};--}}

    {{--var orderDonutData = {!! collect($orderDonutData)->toJson() !!};--}}


    {{--new Morris.Line({--}}
        {{--// ID of the element in which to draw the chart.--}}
        {{--element: 'mysecondchart',--}}
        {{--// Chart data records -- each entry in this array corresponds to a point on--}}
        {{--// the chart.--}}
        {{--data:  orderLineData,--}}
        {{--// The name of the data record attribute that contains x-values.--}}
        {{--xkey: 'new_date',--}}
        {{--// A list of names of data record attributes that contain y-values.--}}
        {{--ykeys: ['count', 'paid'],--}}
        {{--// Labels for the ykeys -- will be displayed when you hover over the--}}
        {{--// chart.--}}
        {{--labels: ['Orders', 'Revenu'],--}}
        {{--xLabels: 'month',--}}
        {{--xLabelAngle: 45,--}}
        {{--fillOpacity: 0.6,--}}
        {{--hideHover: 'auto',--}}
        {{--behaveLikeLine: true,--}}
        {{--resize: true,--}}
        {{--pointFillColors:['#ffffff'],--}}
        {{--pointStrokeColors: ['black'],--}}
        {{--lineColors:['gray','red']--}}
    {{--});--}}

    {{--new Morris.Line({--}}
        {{--// ID of the element in which to draw the chart.--}}
        {{--element: 'myfirstchart',--}}
        {{--// Chart data records -- each entry in this array corresponds to a point on--}}
        {{--// the chart.--}}
        {{--data: userLineData,--}}
        {{--// The name of the data record attribute that contains x-values.--}}
        {{--xkey: 'new_date',--}}
        {{--// A list of names of data record attributes that contain y-values.--}}
        {{--ykeys: ['count'],--}}
        {{--// Labels for the ykeys -- will be displayed when you hover over the--}}
        {{--// chart.--}}
        {{--labels: ['Registered Users'],--}}
        {{--xLabels: 'month',--}}
        {{--xLabelAngle: 45,--}}
        {{--fillOpacity: 0.6,--}}
        {{--hideHover: 'auto',--}}
        {{--behaveLikeLine: true,--}}
        {{--resize: true,--}}
        {{--pointFillColors:['#ffffff'],--}}
        {{--pointStrokeColors: ['black'],--}}
        {{--lineColors:['gray','red']--}}
    {{--});--}}

    {{--new Morris.Donut({--}}
        {{--element: 'donutExample',--}}
        {{--data: orderDonutData--}}
    {{--});--}}
</script>
@endpush
