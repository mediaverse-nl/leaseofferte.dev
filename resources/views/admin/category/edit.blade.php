@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.edit', $category) !!}
@endsection

@section('content')
    {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PATCH']) !!}

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
                           'btnTitle' => 'edit',
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
                                {!! Form::text('rate', '0 ~ 24999', ['disabled', 'class' => 'disabled form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                            </td>
                            <td>
                                {!! Form::number('rate[1]', isset(explode(",", $category->interest_rate)[0]) ? explode(",", $category->interest_rate)[0] : 5.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'value'])
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 {!! Form::text('rate', '25000 ~ 49999', ['disabled', 'class' => 'disabled form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                             </td>
                            <td>
                                {!! Form::number('rate[2]', isset(explode(",", $category->interest_rate)[1]) ? explode(",", $category->interest_rate)[1] : 4.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'value'])
                             </td>
                        </tr>
                        <tr>
                            <td>
                                 {!! Form::text('rates', '50000 ~ 99999', ['disabled', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                             </td>
                            <td>
                                {!! Form::number('rate[3]', isset(explode(",", $category->interest_rate)[2]) ? explode(",", $category->interest_rate)[2] : 3.05, ['min="0.001"max="100"', 'step="any"', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                                @include('components.error', ['field' => 'value'])
                             </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1>Form</h1>
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
{{--                                <th class="rotate">--}}
{{--                                    <div><span>postcode</span></div>--}}
{{--                                </th>--}}
{{--                                <th class="rotate">--}}
{{--                                    <div><span>telefoonnummer_vast</span></div>--}}
{{--                                </th>--}}
{{--                                <th class="rotate">--}}
{{--                                    <div><span>telefoonnummer_mobiel</span></div>--}}
{{--                                </th>--}}
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
                                <th class="">
                                    form part
                                </th>
                                <th class="" colspan="2">
                                    <div><span>options</span></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @php
                                $dynamicFields = $category->dynamicFields()->orderByRaw('form_part ASC, field_order ASC')->get();

                                [
                                "id" => 4,
                                "category_id" => 3,
                                "field_name" => "voornaam",
                                "field_type" => "text",
                                "field_validation" => "required",
                                "form_part" => "2",
                                "field_order" => 4,
                                "created_at" => "",
                                "updated_at" => "",
                                ];
                                 //dd($dynamicFields);
                            @endphp

                            <tr class="ui-state-highlight">

{{--                                @foreach($items as $i => $v)--}}
{{--                                    <td>--}}
{{--                                        @if($checkFields)--}}
{{--                                            <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">{!! null; //dd( $items[$i], str_replace('nullabl e|', '', $field->field_validation)) !!}--}}
{{--                                                {!! Form::checkbox('dynamicFields['.$field->id.'][rules]['.$i.']', $v,  str_contains($field->field_validation, str_replace('nullable|', '', $items[$i])) ? true:false) !!}--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            @if($i !== 'numeric' && $i !== 'active_url')--}}
{{--                                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">{!! null; //dd( $items[$i], str_replace('nullabl e|', '', $field->field_validation)) !!}--}}
{{--                                                    {!! Form::checkbox('dynamicFields['.$field->id.'][rules]['.$i.']', $v,  str_contains($field->field_validation, str_replace('nullable|', '', $items[$i])) ? true:false) !!}--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                {!! Form::hidden('dynamicFields['.$field->id.'][rules]['.$i.']', $v) !!}--}}
{{--                                            @endif--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                @endforeach--}}
                                <td>
{{--                                    {!! Form::hidden('dynamicFields['.$field->id.'][field_order]', $field->id, ['id' => 'sortable_order']) !!}--}}

{{--                                    {!! Form::text('dynamicFields['.$field->id.'][field_name]', $field->field_name, ['disabled', 'class' => 'form-control']) !!}--}}
{{--                                    {!! Form::hidden('dynamicFields['.$field->id.'][field_name]', $field->field_name) !!}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {!! Form::select('dynamicFields['.$field->id.'][field_type]', array_combine(['text', 'textarea', 'number'], ['text', 'textarea', 'number']), $field->field_type, ['disabled', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}--}}
{{--                                    {!! Form::hidden('dynamicFields['.$field->id.'][field_type]', $field->field_type) !!}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {!! Form::select('dynamicFields['.$field->id.'][form_part]', ['2' => 2, '3' => 3], $field->form_part, ['class' => 'form-control'.(!$errors->has('form_part') ? '': ' is-invalid ')]) !!}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="bg-danger" style="border-radius:4px; border: 1px solid #dc3545; padding: .375rem .75rem; ">{!! null; //dd( $items[$i], str_replace('nullabl e|', '', $field->field_validation)) !!}--}}
{{--                                        {!! Form::checkbox('dynamicFields['.$field->id.'][delete]', null, null)!!}--}}
{{--                                    </div>--}}
                                </td>
                            </tr>
                            @foreach($dynamicFields as $field)
{{--                                {!! dd($dynamicFields) !!}--}}
                                <tr class="ui-state-highlight">
                                    @php
                                        $items = [
                                            'required' => 'required',
                                            'email' => 'email',
                                            'numeric' => 'numeric',
                                            'active_url' => 'url',
                                        ];
                                        $checkFields = strtolower($field->field_name) !== 'email'
                                            && strtolower($field->field_name) !== 'voorletter(s)'
                                            && strtolower($field->field_name) !== 'voornaam'
                                            && strtolower($field->field_name) !== 'achternaam'
                                            && strtolower($field->field_name) !== 'k.v.k. nummer'
                                            && strtolower($field->field_name) !== 'bedrijfsnaam';

                                    @endphp
                                    @foreach($items as $i => $v)
                                        <td>
                                            @if($checkFields)
                                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; ">{!! null; //dd( $items[$i], str_replace('nullabl e|', '', $field->field_validation)) !!}
                                                    {!! Form::checkbox('dynamicFields['.$field->id.'][rules]['.$i.']', $v,  str_contains($field->field_validation, str_replace('nullable|', '', $items[$i])) ? true:false) !!}
                                                </div>
                                            @else
                                                <div style="border: 1px solid #ced4da; padding: .375rem .75rem; background-color: #e9ecef;">
                                                    {!! Form::checkbox('dynamicFields['.$field->id.'][rules]['.$i.']', $v, str_contains($field->field_validation, str_replace('nullable|', '', $items[$i])) ? true:false, ['disabled']) !!}
                                                    {!! Form::checkbox('dynamicFields['.$field->id.'][rules]['.$i.']', $v, str_contains($field->field_validation, str_replace('nullable|', '', $items[$i])) ? true:false , ['style="display:none;"']) !!}
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        {!! Form::hidden('dynamicFields['.$field->id.'][field_order]', $field->field_order, ['id' => 'sortable_order']) !!}

                                        @if($checkFields)
                                            {!! Form::text('dynamicFields['.$field->id.'][field_name]', $field->field_name, ['class' => 'form-control'.(!$errors->has('field_name') ? '': ' is-invalid ')]) !!}
                                        @else
                                            {!! Form::text('dynamicFields['.$field->id.'][field_name]', $field->field_name, ['disabled', 'class' => 'form-control']) !!}
                                            {!! Form::hidden('dynamicFields['.$field->id.'][field_name]', $field->field_name) !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if($checkFields)
                                            {!! Form::select('dynamicFields['.$field->id.'][field_type]', array_combine(['text', 'textarea', 'number'], ['text', 'textarea', 'number']), $field->field_type, ['class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                                        @else
                                            {!! Form::select('dynamicFields['.$field->id.'][field_type]', array_combine(['text', 'textarea', 'number'], ['text', 'textarea', 'number']), $field->field_type, ['disabled', 'class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
                                            {!! Form::hidden('dynamicFields['.$field->id.'][field_type]', $field->field_type) !!}

                                        @endif

                                    </td>
                                    <td>
                                        {!! Form::select('dynamicFields['.$field->id.'][form_part]', ['2' => 2, '3' => 3], $field->form_part, ['class' => 'form-control'.(!$errors->has('form_part') ? '': ' is-invalid ')]) !!}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-success btn-block"><i class="fa fa-arrows-alt"></i></a>
                                    </td>
                                    <td>
                                        @if($checkFields)
                                            <div class="bg-danger" style="border-radius:4px; border: 1px solid #dc3545; padding: .375rem .75rem; ">{!! null; //dd( $items[$i], str_replace('nullabl e|', '', $field->field_validation)) !!}
                                                {!! Form::checkbox('dynamicFields['.$field->id.'][delete]', null, null)!!}
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
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
                                {!! Form::select('field_type', array_combine(['text', 'textarea', 'number'], ['text', 'textarea', 'number']), null, ['class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}
{{--                                {!! Form::select('field_type', array_combine(['text', 'textarea', 'number', 'dropdown'], ['text', 'textarea', 'number', 'dropdown']), null, ['class' => 'form-control'.(!$errors->has('value') ? '': ' is-invalid ')]) !!}--}}
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
                                    {!! Form::label('numeric', 'number') !!}</div>
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    {!! Form::checkbox('rules[postcode]', 'regex:/^[1-9][0-9]{3}[\s]?[A-Za-z]{2}$/i', false) !!}--}}
{{--                                    {!! Form::label('rules[postcode]', 'postcode') !!}--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    {!! Form::checkbox('rules[telefoonnummer_vast]', 'regex:#^(((0)[1-9]{2}[0-9][-]?[1-9][0-9]{5})|((\+31|0|0031)[1-9][0-9][-]?[1-9][0-9]{6}))$#', false) !!}--}}
{{--                                    {!! Form::label('rules[telefoonnummer_vast]', 'telefoonnummer_vast') !!}--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    {!! Form::checkbox('rules[telefoonnummer_mobiel]', 'regex:#^(((\+31|0|0031)6){1}[1-9]{1}[0-9]{7})$#i', false) !!}--}}
{{--                                    {!! Form::label('rules[telefoonnummer_mobiel]', 'telefoonnummer_mobiel') !!}--}}
{{--                                </div>--}}
                                <div class="form-check form-check-inline">
                                    {!! Form::checkbox('rules[url]', 'active_url', false) !!}
                                    {!! Form::label('rules[url]', 'url') !!}
                                </div>

                             </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <ul id="sortable">--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>--}}
{{--                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>--}}
{{--            </ul>--}}
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
