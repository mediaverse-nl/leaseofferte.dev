@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.portfolio.edit', $portfolio) !!}
@endsection

@section('content')
    {!! Form::model($portfolio, ['route' => ['admin.portfolio.update', $portfolio->id], 'method' => 'PATCH']) !!}

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                        'id' => 'CreateCategory',
                        'title' => 'Edit entry ',
                        'actionRoute' => route('admin.solution.update', $portfolio->id),
                        'btnClass' => 'btn btn-warning',
                        'btnIcon' => null,
                        'btnTitle' => 'edit',
                    ])
                        @slot('description')
                            If u proceed u will <b>edit</b> this entry
                        @endslot
                    @endcomponent
                    <span class="float-right">updated at: {!! isset($portfolio->updated_at) ? $portfolio->updated_at->format('d-m-Y H:i') : 'nvt' !!}</span>

                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">

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
                                   value="{!! $portfolio->image !!}">
                            {!! Form::hidden('image', $portfolio->image, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}
                        </div>
                        <div id="imgHolder" style="margin-top:15px;">
                            @if(!empty($portfolio->image))
                                @foreach($portfolio->images() as $image)
                                    <img src="{!! $image !!}" style="width: 100% !important;">
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
            /*height: 400px;*/
        }
        #imgHolder img{
            /*height: 400px; !important;*/
            object-fit: contain;
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        var route_prefix = "{!! route('unisharp.lfm.show') !!}";

        $('#lfm').filemanager('file', {
            prefix: route_prefix,
            multiple: false
        });

        function getImagePath(el) {
            $('#productThumbnailCopy').val(el);
        }

        getImagePath($('#productThumbnail').val());

        $('#productThumbnail').change(function() {
            getImagePath($(this).val());
        });
    </script>
@endpush
