@extends('layouts.app')

@section('content')

<div class="jumbotron" style="height: 220px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 150px;">

            <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                    <h1 class="h1" style="color:#006A8E;">Frequently Asked Questions</h1>

                    <div class="accordion" id="faq">
                        @foreach($faqs as $faq)
                            <div class="card">
                                <div class="card-header" id="heading{!! $loop->index !!}">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse{!! $loop->index !!}" aria-expanded="true" aria-controls="collapse{!! $loop->index !!}" style="width: 100%;">
                                            #{!! $loop->index + 1!!} - {!! $faq->title !!}
                                        </button>
                                    </h3>
                                </div>
                                <div id="collapse{!! $loop->index !!}" class="collapse faq-container" aria-labelledby="heading{!! $loop->index !!}" data-parent="#faq">
                                    <div class="card-body">
                                        {!! $faq->description !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/faq.css">
@endpush
