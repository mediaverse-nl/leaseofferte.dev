@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.static-solution.create') !!}
@endsection

@section('content')
    {!! Form::open(['route' => ['admin.static-solution.store'], 'method' => 'POST']) !!}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                           'id' => 'CreateCategory',
                           'title' => 'Create entry ',
                           'actionRoute' => route('admin.static-solution.store'),
                           'btnClass' => 'btn btn-warning',
                           'btnIcon' => null,
                           'btnTitle' => 'Save',
                       ])
                        @slot('description')
                            If u proceed u will <b>edit</b> this entry
                        @endslot
                    @endcomponent

                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h2>algemene informatie</h2>
                    <div class="form-group">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'value'])
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'description') !!}
                        {!! Form::textarea('description', null, ['class' => 'summernote form-control'.(!$errors->has('description') ? '': ' is-invalid '), 'rows' => '8']) !!}
                        @include('components.error', ['field' => 'value'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('uitvoering', 'uitvoering') !!}
                        {!! Form::text('uitvoering', null, ['class' => 'form-control'.(!$errors->has('uitvoering') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'uitvoering'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('merk', 'merk') !!}
                        {!! Form::text('merk', null, ['class' => 'form-control'.(!$errors->has('merk') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'merk'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('type', 'type') !!}
                        {!! Form::text('type', null, ['class' => 'form-control'.(!$errors->has('type') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'type'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('kleur', 'kleur') !!}
                        {!! Form::text('kleur', null, ['class' => 'form-control'.(!$errors->has('kleur') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'kleur'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('inbegrepen', 'inbegrepen') !!}
                        {!! Form::text('inbegrepen', null, ['class' => 'form-control'.(!$errors->has('kleur') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'inbegrepen'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('uitvoering', 'uitvoering') !!}
                        {!! Form::text('uitvoering', null, ['class' => 'form-control'.(!$errors->has('uitvoering') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'uitvoering'])
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>(SEO) search engine optimalisation</h2>

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
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h2>afbeeldingen</h2>
                    <div class="form-group">
                        <label for="">Images</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="productThumbnail" data-preview="imgHolder" class="btn btn-primary text-white" style="border-radius: 0px !important;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="productThumbnail" class="form-control" type="text" disabled value="">
                            {!! Form::hidden('images', null, ['id' => 'productThumbnailCopy', 'class' => 'form-control'.(!$errors->has('images') ? '': ' is-invalid ')]) !!}

                        </div>
                        @include('components.error', ['field' => 'images'])
                        <div id="imgHolder" style="margin-top:15px;max-height:100px;"></div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>lease condities</h2>
                    <div class="form-group">
                        {!! Form::label('kilometrage', 'kilometrage') !!}
                        {!! Form::text('kilometrage', null, ['class' => 'form-control'.(!$errors->has('kilometrage') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'kilometrage'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('looptijd', 'looptijd') !!}
                        {!! Form::select('looptijd[]', array_combine([12,18,24,30,36,42,48,54,60,72], [12,18,24,30,36,42,48,54,60,72]), null, ['data-max-options="3"', 'id="selectpicker"', 'data-live-search="true"', 'multiple', 'class' => 'form-control'.(!$errors->has('looptijd') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'looptijd'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('catalogusprijs', 'catalogusprijs') !!}
                        {!! Form::text('catalogusprijs', null, ['class' => 'form-control'.(!$errors->has('catalogusprijs') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'catalogusprijs'])
                    </div>

                    <div class="form-group">
                        {!! Form::label('bijtelling', 'bijtelling') !!}
                        {!! Form::text('bijtelling', null, ['class' => 'form-control'.(!$errors->has('bijtelling') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'bijtelling'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#selectpicker').selectpicker();

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
