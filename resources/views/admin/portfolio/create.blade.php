@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.portfolio.create') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => ['admin.portfolio.store'], 'method' => 'POST']) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'value'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('branch', 'branch') !!}
                        {!! Form::text('branch', null, ['class' => 'form-control'.(!$errors->has('branch') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'branch'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('location', 'location') !!}
                        {!! Form::text('location', null, ['class' => 'form-control'.(!$errors->has('location') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'location'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('solution_id', 'solution') !!}
                        {!! Form::select('solution_id', $categories->pluck('value', 'id')->toArray(), null, ['placeholder' => '--- select ---', 'class' => 'form-control'.(!$errors->has('solution_id') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'solution_id'])
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
                                       value="">
                                {!! Form::hidden('image', null, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}
                            </div>
                            <div id="imgHolder" style="margin-top:15px;max-height:100px;"></div>
                        </div>

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
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @include('components.rich-textarea-editor')
{{--    @endcomponent--}}

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
