@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
             <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
         </div>
    </div>
    <div class="container">

        <div class="row">

            <div class="col-md-9">

               <h1>{!! $solution->title !!}</h1>
               <p><img src="{!! $solution->thumbnail() !!}" alt="" class="img-thumbnail"></p>
               <p>{!! $solution->description !!}</p>

            </div>
            <div class="col-md-3">
                <div class="grid">

                    @include('components.lease-calculator')

                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <style>
        .jumbotron {
{{--            background-image: url("{!!  !!}");--}}
            background-size: cover;
            background-position: center center;
        }
        .img-thumbnail{
            border: none !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>

    </script>
@endpush
