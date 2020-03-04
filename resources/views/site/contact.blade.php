@extends('layouts.app')

@section('content')
    <div class="jumbotron" style="height: 220px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 5px 0px !important; margin-bottom: 0px !important;">
                    <li class="breadcrumb-item"><a href="{!! route('site.home') !!}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-8" style="margin-bottom: 150px;">

                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
{{--                        <h1 class="h1 pr-1" style="font-size:38px; color:#006A8E;">Neem direct contact op</h1>--}}

                        {!! Editor('contact_paragraaf_1', 'richtext', false, "") !!}

                        {!! Form::open(array('route' => 'site.contact.store', 'method' => 'post')) !!}
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::text('naam', null, ['class' => 'form-control'.(!$errors->has('naam') ? '': ' is-invalid '), 'placeholder' => 'Naam *']) }}
                                        @include('components.error', ['field' => 'naam'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::text('bedrijfnaam', null, ['class' => 'form-control'.(!$errors->has('bedrijfnaam') ? '': ' is-invalid '), 'placeholder' => 'bedrijfnaam']) }}
                                        @include('components.error', ['field' => 'bedrijfnaam'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::text('telefoonnummer', null, ['class' => 'form-control'.(!$errors->has('telefoonnummer') ? '': ' is-invalid '), 'placeholder' => 'Telefoonnummer *']) }}
                                        @include('components.error', ['field' => 'telefoonnummer'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::email('email', null, ['class' => 'form-control'.(!$errors->has('email') ? '': ' is-invalid '), 'placeholder' => 'E-mail *']) }}
                                        @include('components.error', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::textarea('bericht', null, ['rows="5"','class' => 'form-control'.(!$errors->has('bericht') ? '': ' is-invalid '), 'id' => 'input_message', 'placeholder' => 'Bericht/Opmerking *']) }}
                                @include('components.error', ['field' => 'bericht'])
                            </div>

                            {!! NoCaptcha::display() !!}
                            @if($errors->has('g-recaptcha-response'))
                                <div style="margin-top: -15px !important;">
                                    @include('components.error', ['field' => 'g-recaptcha-response'])
                                </div>
                                <br>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default" style="background: #006486 !important;" value="Submit">verzend bericht</button>
                            <br>
                            <small class="text-muted">Alle velden met een * zijn verplicht</small>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>

                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: 30px !important;">
                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                        <span class="h1" style="color:#006A8E;">Ons team</span>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-3 text-center" style="margin-bottom: 20px;">
                                <div style="height: 160px; width: 100%; margin-bottom: 5px;">
                                    <img src="https://uilove.in/realestate/listo/preview/img/profile-placeholder.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Ginger</span>
                            </div>
                            <div class="col-md-3 text-center">
                                <div style="height: 160px; width: 100%; margin-bottom: 5px;">
                                    <img src="https://uilove.in/realestate/listo/preview/img/profile-placeholder.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Dion</span>
                            </div>
                            <div class="col-md-3 text-center">
                                <div style="height: 160px; width: 100%; margin-bottom: 5px;">
                                    <img src="https://uilove.in/realestate/listo/preview/img/profile-placeholder.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Ray</span>
                            </div>
                            <div class="col-md-3 text-center">
                                <div style="height: 160px; width: 100%; margin-bottom: 5px;">
                                    <img src="https://uilove.in/realestate/listo/preview/img/profile-placeholder.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Jan</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4" style="margin-bottom: 150px;">

                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">

                        {!! Editor('contact_paragraaf_2', 'richtext', false, "") !!}

                        <iframe width="100%"
                                height="350"
                                frameborder="0"
                                style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?q=place_id:EipIb29mZHZlc3RlIDMyLCAzOTkyIERHIEhvdXRlbiwgTmV0aGVybGFuZHMiMBIuChQKEgkz-33MkWbGRxHIvP5AudsbhBAgKhQKEgnr07UsjmbGRxFoD5CnvOY-3g&key=AIzaSyC3-qPWD0Ya3yxdRTs7ctykgWDlExj8m8A" allowfullscreen>
                        </iframe>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @component('components.portfolio-banner')

    @endcomponent

@endsection

@push('css')
<style>
    .g-recaptcha {
        transform:scale(0.77);
        transform-origin:0 0;
    }
    h1, h2{
        color: #006A8E !important;
    }
    .jumbotron {
        background-color: #009FD6;
        background-size: cover;
        background-position: center center;
        border-radius: 0px;
        color: #FFFFFF;
    }
    .img-thumbnail{
        border: none !important;
    }
    .card-header{
        border-radius: 0px !important;
    }
</style>
@endpush

@push('js')
{!! NoCaptcha::renderJs() !!}

<script>
</script>
@endpush
