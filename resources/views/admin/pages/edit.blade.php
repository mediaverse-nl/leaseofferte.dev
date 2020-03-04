@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.pages.edit', $page) !!}
@endsection

@section('content')
    {!! Form::model($page, ['route' => ['admin.pages.update', $page->id], 'method' => 'PATCH']) !!}

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                       'id' => 'CreateCategory',
                       'title' => 'Edit entry ',
                       'actionRoute' => route('admin.pages.update', $page->id),
                       'btnClass' => 'btn btn-warning',
                       'btnIcon' => null,
                       'btnTitle' => 'Save',
                   ])
                        @slot('description')
                            If u proceed u will <b>update</b> this entry
                        @endslot
                    @endcomponent
                    <span class="float-right">updated at: {!! isset($page->updated_at) ? $page->updated_at->format('d-m-Y H:i') : 'nvt' !!}</span>

                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::hidden('id', null) !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" style="padding-left: 20px;">
                                {!! Form::label('status', 'live page', ['style' => 'margin-left: -20px;']) !!}
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('status', null, null, ['data-toggle' => 'toggle']) !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" style="padding-left: 20px;">
                                {!! Form::label('options', 'show link in footer', ['style' => 'margin-left: -20px;']) !!}
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('options', null, null, ['data-toggle' => 'toggle']) !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control'.(!$errors->has('slug') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'slug'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'title'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('body', 'body') !!}
                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class' => 'summernote', 'style' => 'border-radius: 0px']) !!}
                        </div>
                        @include('components.error', ['field' => 'body'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_title', 'meta_title') !!}
                        {!! Form::text('meta_title', null, ['class' => 'form-control'.(!$errors->has('meta_title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'meta_title'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_description', 'meta_description') !!}
                        {!! Form::textarea('meta_description', null, ['class' => 'form-control'.(!$errors->has('meta_description') ? '': ' is-invalid '), 'rows' => '3']) !!}
                        @include('components.error', ['field' => 'meta_description'])
                    </div>

                    {{--<div class="form-group">--}}
                    {{--<label for="">Images</label>--}}
                    {{--<div class="input-group">--}}
                    {{--<span class="input-group-btn">--}}
                    {{--<a id="lfm" data-input="productThumbnail" data-preview="imgHolder" class="btn btn-primary text-white" style="border-radius: 0px !important;">--}}
                    {{--<i class="fa fa-picture-o"></i> Choose--}}
                    {{--</a>--}}
                    {{--</span>--}}
                    {{--<input id="productThumbnail" class="form-control" type="text" disabled--}}
                    {{--value="">--}}
                    {{--{!! Form::hidden('image', null, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}--}}
                    {{--</div>--}}
                    {{--<div id="imgHolder" style="margin-top:15px;max-height:100px;"></div>--}}
                    {{--</div>--}}




                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .btn-default.active.toggle-off{
            background: #eeeeee !important;
        }
        .note-editable.card-block{
            height: 250px;
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        var route_prefix = "{!! route('unisharp.lfm.show') !!}";

        $('#lfm').filemanager('file', {prefix: route_prefix});

        function getImagePath(el) {
            $('#productThumbnailCopy').val(el);
        }

        getImagePath($('#productThumbnail').val());

        $('#productThumbnail').change(function() {
            getImagePath($(this).val());
        });
    </script>
@endpush
