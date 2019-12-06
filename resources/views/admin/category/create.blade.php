@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.create') !!}
@endsection

@section('content')
    {!! Form::open(['route' => ['admin.category.store'], 'method' => 'POST']) !!}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @component('components.model', [
                           'id' => 'CreateCategory',
                           'title' => 'Create entry ',
                           'actionRoute' => route('admin.category.store'),
                           'btnClass' => 'btn btn-warning',
                           'btnIcon' => null,
                           'btnTitle' => 'save',
                       ])
                        @slot('description')
                            If u proceed u will <b>create</b> this entry
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('value', 'value') !!}
                        {!! Form::text('value', null, ['class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                        @include('components.error', ['field' => 'value'])
                    </div>
                    <table class="w3-table">
                        <tr>
                            <th>financial rates</th>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text('rate', '0 ~ 24999', ['disabled', 'class' => 'disabled form-control'.(!$errors->has('rate[1]') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[1]', 5.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[1]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[1]'])
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text('rate', '25000 ~ 49999', ['disabled', 'class' => 'disabled form-control'.(!$errors->has('rate[2]') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[2]', 4.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[2]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[2]'])
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text('rates', '50000 ~ 99999', ['disabled', 'class' => 'form-control'.(!$errors->has('rate[3]') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[3]', 3.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[3]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[3]'])
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2>New field</h2>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('field_name', 'field_name') !!}
                                {!! Form::text('field_name', null, ['class' => 'form-control'.(!$errors->has('field_name') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'field_name'])
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('field_type', 'field_type') !!}
                                {!! Form::select('field_type', array_combine(['text', 'textarea', 'number'], ['text', 'textarea', 'number']), null, ['class' => 'form-control'.(!$errors->has('field_type') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'field_type'])
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('form_part', 'form_part') !!}
                                {!! Form::select('form_part', ['2' => 2, '3' => 3], null, ['class' => 'form-control'.(!$errors->has('form_part') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'form_part'])
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" style="margin-right: 10px;"><b>Rules: </b> </label>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('rules[required]', null, false) !!}
                                {!! Form::label('required', 'required') !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('rules[email]', null, false) !!}
                                {!! Form::label('email', 'email') !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('rules[numeric]', null, false) !!}
                                {!! Form::label('numeric', 'number') !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('rules[url]', 'active_url', false) !!}
                                {!! Form::label('rules[url]', 'url') !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}


@endsection

@push('css')
    <style>
        .ui-state-highlight td input[type="checkbox"]{
            padding: 17px;
        }
        th{
            height: 0px !important;
        }
        th.rotate {
            /* Something you can count on */
            height: 140px !important;
            white-space: nowrap;
        }

        th.rotate > div {
            transform:
                /* Magic Numbers */
                translate(0px, 51px)
                    /* 45 is really 360 - 45 */
                rotate(270deg);
            width: 25px;
        }
        th.rotate > div > span {
            border-bottom: 1px solid #ced4da;
            /*padding: 5px 10px;*/
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        $( function() {
            $("#sortable").sortable({
                placeholder: "ui-state-highlight",
                helper: 'clone',
                sort: function(e, ui) {
                    $(ui.placeholder).html(Number($("#sortable > tr:visible").index(ui.placeholder)) + 1);
                },
                update: function(event, ui) {
                    var $lis = $(this).children('tr');
                    $lis.each(function() {
                        var $li = $(this);
                        var newVal = $(this).index() + 1;
                        $(this).find('#sortable_order').val(newVal).change();
                        $(this).find('#item_display_order').val(newVal).change();
                    });
                }
            });
            $("#sortable_nav").disableSelection();
        } );

    </script>
    {{--    <script>--}}
    {{--        var route_prefix = "{!! route('unisharp.lfm.show') !!}";--}}

    {{--        $('#lfm').filemanager('file', {prefix: route_prefix});--}}

    {{--        function getImagePath(el) {--}}
    {{--            $('#productThumbnailCopy').val(el);--}}
    {{--        }--}}

    {{--        getImagePath($('#productThumbnail').val());--}}

    {{--        $('#productThumbnail').change(function() {--}}
    {{--            getImagePath($(this).val());--}}
    {{--        });--}}
    {{--    </script>--}}
@endpush
