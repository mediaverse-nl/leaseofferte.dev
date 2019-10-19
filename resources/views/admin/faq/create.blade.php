@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.faq.create') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-header">
                    make a new frequently asked questions (FAQ) item
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['admin.faq.store'], 'method' => 'POST']) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control'.(!$errors->has('title') ? '': ' is-invalid ')]) !!}
                            @include('components.error', ['field' => 'title'])
                        </div>

                        <div class="form-group">
                            @include('components.error', ['field' => 'description'])

                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'summernote '.(!$errors->has('description') ? '': ' is-invalid ')]) !!}
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

@push('scripts')
    <script>
        $('.summernote').on("change", function(){
            $('textarea[name="description"]').html($('.summernote').code());
        });
    </script>
@endpush