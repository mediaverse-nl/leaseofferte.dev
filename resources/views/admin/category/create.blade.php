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
                    <h2>Category</h2>
                    <div class="form-group">
                        {!! Form::label('value', 'title') !!}
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
                                {!! Form::number('rate[1]', 0.0580, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[1]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[1]'])
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text('rate', '25000 ~ 49999', ['disabled', 'class' => 'disabled form-control'.(!$errors->has('rate[2]') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[2]', 0.0540, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[2]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[2]'])
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text('rates', '50000 ~ 99999', ['disabled', 'class' => 'form-control'.(!$errors->has('rate[3]') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[3]', 0.0480, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('rate[3]') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'rate[3]'])
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1>New field</h1>
                    <table>
                        <thead>


                        <tr>
                            <th class="rotate">
                                <div><span>required</span></div>
                            </th>
                            <th class="rotate">
                                <div><span>email</span></div>
                            </th>
                            <th class="rotate">
                                <div><span>numeric</span></div>
                            </th>









                            <th class="rotate">
                                <div><span>active_url</span></div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-center">rules</th>
                            <th class="">
                                field name
                            </th>
                            <th class="">
                                field type
                            </th>
{{--                            <th class="">--}}
{{--                                form part--}}
{{--                            </th>--}}
{{--                            <th class="" colspan="2">--}}
{{--                             </th>--}}
                        </tr>
                        </thead>
                        <tbody id="sortable" class="ui-sortable">

{{--                        <tr class="ui-state-highlight ui-sortable-handle">--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input checked="checked" name="dynamicFields[4][rules][required]" type="checkbox" value="required">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[4][rules][email]" type="checkbox" value="email">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[4][rules][numeric]" type="checkbox" value="numeric">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[4][rules][active_url]" type="checkbox" value="url">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input id="sortable_order" name="dynamicFields[4][field_order]" type="hidden" value="4">--}}

{{--                                <input class="form-control" name="dynamicFields[4][field_name]" type="text" value="Type (uitvoering)">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[4][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[4][form_part]"><option value="2" selected="selected">2</option><option value="3">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr class="ui-state-highlight ui-sortable-handle">--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[23][rules][required]" type="checkbox" value="required">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[23][rules][email]" type="checkbox" value="email">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[23][rules][numeric]" type="checkbox" value="numeric">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[23][rules][active_url]" type="checkbox" value="url">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input id="sortable_order" name="dynamicFields[23][field_order]" type="hidden" value="23">--}}

{{--                                <input class="form-control" name="dynamicFields[23][field_name]" type="text" value="Website URL link">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[23][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[23][form_part]"><option value="2" selected="selected">2</option><option value="3">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr class="ui-state-highlight ui-sortable-handle">--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input checked="checked" name="dynamicFields[14][rules][required]" type="checkbox" value="required">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[14][rules][email]" type="checkbox" value="email">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[14][rules][numeric]" type="checkbox" value="numeric">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[14][rules][active_url]" type="checkbox" value="url">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input id="sortable_order" name="dynamicFields[14][field_order]" type="hidden" value="14">--}}

{{--                                <input class="form-control" name="dynamicFields[14][field_name]" type="text" value="Telefoon mobiel">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[14][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[14][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}


{{--                        <tr class="ui-state-highlight ui-sortable-handle">--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input checked="checked" name="dynamicFields[16][rules][required]" type="checkbox" value="required">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[16][rules][email]" type="checkbox" value="email">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[16][rules][numeric]" type="checkbox" value="numeric">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[16][rules][active_url]" type="checkbox" value="url">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input id="sortable_order" name="dynamicFields[16][field_order]" type="hidden" value="16">--}}

{{--                                <input class="form-control" name="dynamicFields[16][field_name]" type="text" value="Geboortedatum">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[16][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[16][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}


{{--                        <tr class="ui-state-highlight ui-sortable-handle">--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[20][rules][required]" type="checkbox" value="required">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[20][rules][email]" type="checkbox" value="email">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[20][rules][numeric]" type="checkbox" value="numeric">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">--}}
{{--                                    <input name="dynamicFields[20][rules][active_url]" type="checkbox" value="url">--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input id="sortable_order" name="dynamicFields[20][field_order]" type="hidden" value="20">--}}

{{--                                <input class="form-control" name="dynamicFields[20][field_name]" type="text" value="Telefoon vast">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[20][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[20][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[76][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[76][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[76][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" checked="checked" name="dynamicFields[76][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[76][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" name="dynamicFields[76][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[76][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[76][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[76][field_order]" type="hidden" value="76">

                                <input disabled="" class="form-control" name="dynamicFields[76][field_name]" type="text" value="email">
                                <input name="dynamicFields[76][field_name]" type="hidden" value="email">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[76][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[76][field_type]" type="hidden" value="text">


{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[76][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[77][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[77][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[77][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" name="dynamicFields[77][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[77][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" name="dynamicFields[77][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[77][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[77][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[77][field_order]" type="hidden" value="77">

                                <input disabled="" class="form-control" name="dynamicFields[77][field_name]" type="text" value="voorletter(s)">
                                <input name="dynamicFields[77][field_name]" type="hidden" value="voorletter(s)">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[77][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[77][field_type]" type="hidden" value="text">


                            </td>
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[77][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[78][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[78][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[78][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" name="dynamicFields[78][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[78][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" name="dynamicFields[78][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[78][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[78][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[78][field_order]" type="hidden" value="78">

                                <input disabled="" class="form-control" name="dynamicFields[78][field_name]" type="text" value="voornaam">
                                <input name="dynamicFields[78][field_name]" type="hidden" value="voornaam">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[78][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[78][field_type]" type="hidden" value="text">


                            </td>
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[78][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[79][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[79][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[79][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" name="dynamicFields[79][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[79][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" name="dynamicFields[79][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[79][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[79][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[79][field_order]" type="hidden" value="79">

                                <input disabled="" class="form-control" name="dynamicFields[79][field_name]" type="text" value="achternaam">
                                <input name="dynamicFields[79][field_name]" type="hidden" value="achternaam">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[79][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[79][field_type]" type="hidden" value="text">


                            </td>
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[79][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[80][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[80][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[80][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" name="dynamicFields[80][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[80][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" checked="checked" name="dynamicFields[80][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[80][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[80][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[80][field_order]" type="hidden" value="80">

                                <input disabled="" class="form-control" name="dynamicFields[80][field_name]" type="text" value="K.v.K. nummer">
                                <input name="dynamicFields[80][field_name]" type="hidden" value="K.v.K. nummer">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[80][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[80][field_type]" type="hidden" value="text">


                            </td>
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[80][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>


                        <tr class="ui-state-highlight ui-sortable-handle">
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" checked="checked" name="dynamicFields[81][rules][required]" type="checkbox" value="required">
                                    <input style="display:none;" checked="checked" name="dynamicFields[81][rules][required]" type="checkbox" value="required">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[81][rules][email]" type="checkbox" value="email">
                                    <input style="display:none;" name="dynamicFields[81][rules][email]" type="checkbox" value="email">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[81][rules][numeric]" type="checkbox" value="numeric">
                                    <input style="display:none;" name="dynamicFields[81][rules][numeric]" type="checkbox" value="numeric">
                                </div>
                            </td>
                            <td>
                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                    <input disabled="" name="dynamicFields[81][rules][active_url]" type="checkbox" value="url">
                                    <input style="display:none;" name="dynamicFields[81][rules][active_url]" type="checkbox" value="url">
                                </div>
                            </td>
                            <td>
                                <input id="sortable_order" name="dynamicFields[81][field_order]" type="hidden" value="81">

                                <input disabled="" class="form-control" name="dynamicFields[81][field_name]" type="text" value="bedrijfsnaam">
                                <input name="dynamicFields[81][field_name]" type="hidden" value="bedrijfsnaam">
                            </td>
                            <td>
                                <select disabled="" class="form-control" name="dynamicFields[81][field_type]"><option value="text" selected="selected">text</option><option value="textarea">textarea</option><option value="number">number</option></select>
                                <input name="dynamicFields[81][field_type]" type="hidden" value="text">


                            </td>
{{--                            <td>--}}
{{--                                <select class="form-control" name="dynamicFields[81][form_part]"><option value="2">2</option><option value="3" selected="selected">3</option></select>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                            </td>--}}
                        </tr>

                        </tbody>
                    </table>
                    <hr>
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
