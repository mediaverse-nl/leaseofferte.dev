@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">



                        test NoCaptcha

                        {!! NoCaptcha::renderJs('fr', true, 'recaptchaCallback') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush
