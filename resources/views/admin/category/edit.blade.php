@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.edit', $category) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PATCH']) !!}

                        <div class="form-group">
                            {!! Form::label('value', 'value') !!}
                            {!! Form::text('value', null, ['class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'value'])
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
                                       {{--value="{!! $category->image !!}">--}}
                                {{--{!! Form::hidden('image', $category->image, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}--}}
                            {{--</div>--}}
                            {{--<div id="imgHolder" style="margin-top:15px;max-height:100px;">--}}
                                {{--@if(!empty($category->image))--}}
                                    {{--@foreach($category->images() as $image)--}}
                                        {{--<img src="{!! $image !!}" style="height: 5rem;">--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        @component('components.model', [
                            'id' => 'CreateCategory',
                            'title' => 'Create entry ',
                            'actionRoute' => route('admin.category.store'),
                            'btnClass' => 'btn btn-warning',
                            'btnIcon' => null,
                            'btnTitle' => 'edit',
                        ])
                            @slot('description')
                                If u proceed u will <b>edit</b> this entry
                            @endslot
                        @endcomponent
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

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
