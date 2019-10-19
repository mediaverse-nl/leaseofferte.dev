@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.faq.edit', $faq) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-header">
                    edit frequently asked questions (FAQ) item
                </div>
                <div class="card-body">
                    {!! Form::model($faq, ['route' => ['admin.faq.update', $faq->id], 'method' => 'PATCH']) !!}
                        {!! Form::hidden('id', $faq->id) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'title'])
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'summernote '.(!$errors->has('description') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'description'])
                        </div>
                        <button class="btn btn-warning" type="submit">Save</button>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @component('components.rich-textarea-editor')
    @endcomponent

@endsection

{{--@push('css')--}}
    {{--<style>--}}

    {{--</style>--}}
{{--@endpush--}}

{{--@push('js')--}}
    {{--<script>--}}

    {{--</script>--}}
{{--@endpush--}}