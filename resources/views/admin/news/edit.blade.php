@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.news.edit', $news) !!}
@endsection

@section('content')
    {!! Form::model($news, ['route' => ['admin.news.update', $news->id], 'method' => 'PATCH']) !!}

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                        'id' => 'CreateCategory',
                        'title' => 'Edit entry ',
                        'actionRoute' => route('admin.news.update', $news->id),
                        'btnClass' => 'btn btn-warning',
                        'btnIcon' => null,
                        'btnTitle' => 'edit',
                    ])
                        @slot('description')
                            If u proceed u will <b>edit</b> this entry
                        @endslot
                    @endcomponent
                    <span class="float-right">updated at: {!! isset($news->updated_at) ? $news->updated_at->format('d-m-Y H:i') : 'nvt' !!}</span>

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
                            <input id="productThumbnail" class="form-control" type="text" disabled
                                   value="{!! $news->image !!}">
                            {!! Form::hidden('image', $news->image, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}
                        </div>
                        <div id="imgHolder" style="margin-top:15px;">
                            @if(!empty($news->image))
                                @foreach($news->images() as $image)
                                    <img src="{!! $image !!}"  style="width: 100% !important;">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

@push('scripts')
    <style>
        #imgHolder{
            height: 400px;
        }
        #imgHolder img{
            height: 400px; !important;
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
