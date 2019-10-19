@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.seo-manager.edit', $seo) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($seo, ['route' => ['admin.seo-manager.update', $seo->id], 'method' => 'PATCH']) !!}
                        {!! Form::hidden('id', $seo->id) !!}
                        <div class="form-group">
                            {!! Form::label('route_name', 'Page name') !!}

                            {!! Form::text('url', route($seo->route_name), ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid '), 'disabled']) !!} <br>
                            {!! Form::text('route_name', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid '), 'disabled']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'title'])
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control'.(!$errors->has('description') ? '': ' is-invalid '), 'rows' => '4']) !!}
                            @include('components.error', ['field' => 'description'])
                        </div>

                        <div class="form-group">
                            {!! Form::label('updated_at', 'Updated at') !!}
                            {!! Form::text('updated_at', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid '), 'disabled']) !!}
                        </div>

                        @component('components.model', [
                               'id' => 'EditCategory',
                               'title' => 'Edit entry ',
                               'btnClass' => 'btn btn-warning',
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

@endsection
