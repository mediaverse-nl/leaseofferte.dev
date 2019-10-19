@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.image.index') !!}
@endsection

@section('content')

    <iframe src="{!! route('unisharp.lfm.show') !!}" style="width: 100%; height: 80vh; overflow: hidden; border: none;"></iframe>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>

    <script>

    </script>
@endpush