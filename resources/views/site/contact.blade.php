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
                        <h1 class="h1" style="color:#006A8E;">Neem direct contact op</h1>
                        <br>


                        {{--test NoCaptcha--}}

                        {{--{!! NoCaptcha::renderJs('fr', true, 'recaptchaCallback') !!}--}}

                        {!! Editor('contact_paragraaf_1', 'richtext', false, "") !!}

                        {!! Form::open(array('route' => 'site.contact.store', 'method' => 'post')) !!}
                        <div>

                            <div class="form-group">
                                @include('components.error', ['field' => 'naam'])
                                {{ Form::text('naam', null, ['class' => 'form-control'.(!$errors->has('naam') ? '': ' is-invalid '), 'placeholder' => 'Naam']) }}
                            </div>

                            <div class="form-group">
                                @include('components.error', ['field' => 'email'])
                                {{ Form::email('email', null, ['class' => 'form-control'.(!$errors->has('email') ? '': ' is-invalid '), 'placeholder' => 'E-mail']) }}
                            </div>

                            <div class="form-group">
                                @include('components.error', ['field' => 'telefoonnummer'])
                                {{ Form::email('telefoonnummer', null, ['class' => 'form-control'.(!$errors->has('telefoonnummer') ? '': ' is-invalid '), 'placeholder' => 'Telefoonnummer']) }}
                            </div>

                            <div class="form-group">
                                @include('components.error', ['field' => 'bericht'])
                                {{ Form::textarea('bericht', null, ['class' => 'form-control'.(!$errors->has('bericht') ? '': ' is-invalid '), 'id' => 'input_message', 'placeholder' => 'Bericht/Opmerking']) }}
                            </div>

                            {!! NoCaptcha::display() !!}
                            @include('components.error', ['field' => 'g-recaptcha-response'])

                            <br>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default" value="Submit">verzend bericht</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>

            <div class="col-md-4" style="margin-bottom: 150px;">

                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">

                    <div class="card-body" style="padding: 30px; padding-bottom: 60px;">
                        <h1 class="h1" style="color:#006A8E;">Contactgegevens</h1>
                        <br>

                        {!! Editor('contact_paragraaf_2', 'richtext', false, "") !!}

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('css')
<style>
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
