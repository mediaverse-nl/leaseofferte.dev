@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active">  Lease categorieën  </li>
                </ol>
            </nav>
            <div class="row" style="padding: 30px 0px 100px 0px;">
                <div class="col-12">
                    <span class="display-4">Lease categorieën </span>
                    <br>
                    <p class="lead">Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt.</p>
                    <br>
                    <div id="cover">
                        <div class="td" style="width:90%;">
                            <input type="text" placeholder="ZOEK HIER OP TREFWOORD" class="quicksearch" required>
                        </div>
                        <div class="td" id="s-cover">
                            <i class="fa fa-search float-right" ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important; margin-bottom: 120px !important;">
                    <div class="card-body">
                        <div id="filters" class="button-group" data-filter-group="choices">

                            <h1 style="color: #006A8E;">Categorie</h1>

                            <label class="checkbox">Toon alle lease oplossingen
                                <input type="radio" name="option" value="*" checked="checked">
                                <span class="checkmark"></span>
                            </label>

                            @foreach($categories as $category)
                                <label class="checkbox">
                                    {!! $category->value !!}
                                    <input type="radio" name="option" value=".category-{!! $category->id !!}" {!! $category->id == request()->category ? 'checked="checked"' : '' !!} >
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="card" style="overflow: hidden; border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
                    <div class="card-body">
                        <div class="grid">
                            @foreach($solutions as $solution)
                                <div class="grid-item category-{!! $solution->category_id !!}" style="padding: 10px;" onmouseover='$("#content-{!! $solution->id !!}").show();' onmouseout='$("#content-{!! $solution->id !!}").hide();'>
                                    <a href="{!! route('site.solution.show', [$solution->urlTitle, $solution->id]) !!}" style="text-decoration: none;">
                                        <div role="img" aria-label="{!! $solution->title !!}" style="background-image: url('{!! str_replace('https://mediaverse-dev.nl/', '/', $solution->thumbnail()) !!}'); height: 100%; background-position: center center; background-repeat:no-repeat; background-size: contain !important;">

                                        </div>

                                        <span style="margin-left: -10px;">
                                            <div class="" id="content-{!! $solution->id !!}" style='margin-top: -25px; width:100%;display:none; background: #009FD6;'>
                                                <p class="text-center font-weight-bold" style=" border: none; color: #FFFFFF;text-transform: uppercase; padding: 15px;" >bereken uw lease</p>
                                            </div>
                                            <h2 style=" font-size: 14px; padding: 15px 0px; margin-top: -25px; background: #fff; bottom: 0px;" class="text-center font-weight-bold">
                                                {!! $solution->title !!}
                                            </h2>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/solutions.css">
    <style>

    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="/js/solutions.js"></script>
@endpush
