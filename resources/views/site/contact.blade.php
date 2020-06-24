@extends('layouts.app')

@section('content')

    @include('components.success-order-model')

    @if(session()->exists('sended'))
        <div class="modal fade in" id="lastNoteModel" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fas fa-times" style="color: #006A8E; font-size: 20px;"></i>
                        </button>

                        <span class="h3" style="color: #006A81; font-weight: bold">
                         <i class="fas fa-thumbs-up" style="color: #006A8E; font-size: 30px;"></i>
                            Uw <span style="color: #009FD6">bericht</span> is in goede orde ontvangen en bevestiging hiervan zit in uw e-mailbox <span style="color: #009FD6">
                        </span>
                    </span>
                        <br>
                        <br>
                        <span style="color: #6c757d;">
                        Wij zullen zo spoedig mogelijk contact met u opnemen. <br><br>
                        <span class="h5" style="font-weight: bold">Direct contact met een van onze lease specialisten</span>
                        <br>
                        <br>
                        ☎ (030) 227 16 19
                    </span>
                    </div>
                </div>
            </div>
        </div>
    @endif


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
                            <button type="submit" class="btn btn-default" style="background: #006486 !important;" value="Submit">Verzend bericht</button>
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
                            <div class="col-md-6 col-6 col-lg-3 text-center">
                                <div style="height: 190px; width: 100%; margin-bottom: 5px;">
                                    <img src="/storage/files/shares/team/thumbs/ginger.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Ginger</span>
                            </div>
                            <div class="col-md-6 col-6 col-lg-3 text-center">
                                <div style="height: 190px; width: 100%; margin-bottom: 5px;">
                                    <img src="/storage/files/shares/team/thumbs/dion.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
{{--                                    <picture class="img-fl uid" style="object-fit: cover !important; height: 100%; width: 100%;">--}}
{{--                                        <source srcset="photo.jxr" type="image/vnd.ms-photo">--}}
{{--                                        <source srcset="photo.jp2" type="image/jp2">--}}
{{--                                        <source srcset="/img/profiles/c3d0adf2-7baa-40c2-a468-af943ffedce0.webp" type="image/webp">--}}
{{--                                        <img srcset="photo.jpg" alt="My beautiful face">--}}
{{--                                    </picture>--}}
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Dion</span>
                            </div>
                            <div class="col-md-6 col-6 col-lg-3 text-center">
                                <div style="height: 190px; width: 100%; margin-bottom: 5px;">
                                    <img src="/storage/files/shares/team/thumbs/danielle.jpg"
                                         class="img-fl uid"
                                         style="object-fit: cover !important; height: 100%; width: 100%;">
                                </div>
                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Daniëlle</span>
                            </div>
{{--                            <div class="col-md-6 col-6 col-lg-3 text-center">--}}
{{--                                <div style="height: 190px; width: 100%; margin-bottom: 5px;">--}}
{{--                                    <img src="https://uilove.in/realestate/listo/preview/img/profile-placeholder.jpg"--}}
{{--                                         class="img-fl uid"--}}
{{--                                         style="object-fit: cover !important; height: 100%; width: 100%;">--}}
{{--                                </div>--}}
{{--                                <span class="h5" style="color: #006A8E !important; font-weight: 500;">Jan</span>--}}
{{--                            </div>--}}
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
    <link rel="stylesheet" href="/css/contact.css">
@endpush

@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush
