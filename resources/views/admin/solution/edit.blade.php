@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.solution.edit', $solution) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($solution, ['route' => ['admin.solution.update', $solution->id], 'method' => 'PATCH']) !!}
                    {{--{!! dd($solution->categories); !!}--}}

                        <div class="form-group">
                            {!! Form::label('title', 'title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'value'])
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'category_id') !!}
                            {!! Form::select('category_id', $solution->categories, null, ['class' => 'form-control'.(!$errors->has('category_id') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'category_id'])
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'samples') !!}

                            <div style="background: #009FD6; height: 40px; width: 40px;"></div>
                            <div style="background: #006A8E; height: 40px; width: 40px;"></div>
                            <div style="background: #F78E0C; height: 40px; width: 40px;"></div>
                            <div style="background: #424242; height: 40px; width: 40px;"></div>
                            <div style="background: #6c757d; height: 40px; width: 40px;"></div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'description') !!}
                            {!! Form::textarea('description', null, ['class' => 'summernote form-control'.(!$errors->has('description') ? '': ' is-invalid '), 'rows' => '12']) !!}
                            @include('components.error', ['field' => 'value'])
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

                        <div class="form-group">
                            <label for="">Images</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="productThumbnail" data-preview="imgHolder" class="btn btn-primary text-white" style="border-radius: 0px !important;">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="productThumbnail" class="form-control" type="text" disabled
                                       value="{!! $solution->image !!}">
                                {!! Form::hidden('image', $solution->image, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}
                            </div>
                            <div id="imgHolder" style="margin-top:15px;max-height:100px;">
                                @if(!empty($solution->image))
                                    @foreach($solution->images() as $image)
                                        <img src="{!! $image !!}" style="height: 5rem;">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        @component('components.model', [
                            'id' => 'CreateCategory',
                            'title' => 'Edit entry ',
                            'actionRoute' => route('admin.solution.update', $solution->id),
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
