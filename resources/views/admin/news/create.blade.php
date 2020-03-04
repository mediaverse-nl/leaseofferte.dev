@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.news.create') !!}
@endsection

@section('content')
    {!! Form::open(['route' => ['admin.news.store'], 'method' => 'POST']) !!}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                         'id' => 'CreateCategory',
                         'title' => 'Create entry ',
                         'actionRoute' => route('admin.solution.store'),
                         'btnClass' => 'btn btn-warning',
                         'btnIcon' => null,
                         'btnTitle' => 'Save',
                     ])
                        @slot('description')
                            If u proceed u will <b>create</b> this entry
                        @endslot
                    @endcomponent
{{--                    <span class="float-right">updated at: {!! isset($news->updated_at) ? $news->updated_at->format('d-m-Y H:i') : 'nvt' !!}</span>--}}

                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'title'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'description') !!}
                        <div class="form-group">
                            {!! Form::textarea('description', null, ['class' => 'summernote', 'style' => 'border-radius: 0px']) !!}
                        </div>
                        @include('components.error', ['field' => 'description'])
                    </div>

                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Image</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="productThumbnail" data-preview="imgHolder" class="btn btn-primary text-white" style="border-radius: 0px !important;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="productThumbnail" class="form-control" type="text" disabled value="">
                            {!! Form::hidden('image', null, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('image') ? '': ' is-invalid ')]) !!}
                        </div>
                        @include('components.error', ['field' => 'image'])
                        <div id="imgHolder" style="margin-top:15px;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @include('components.rich-textarea-editor')

@endsection

@push('scripts')
    <style>
        #imgHolder{
            height: 400px;
        }
        #imgHolder img{
            width: 100% !important;
            height: 400px !important;
            object-fit: contain;
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
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
