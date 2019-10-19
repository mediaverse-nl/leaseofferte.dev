@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.editor.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.datatable')
                @slot('head')
                    <th>key name</th>
                    <th style="width: 100px;">field type</th>
                    <th>text</th>
                    <th class="no-sort"></th>
                @endslot

                @slot('table')
                    @foreach($texts as $text)
                        <tr>
                            <td>{{$text->key_name}}</td>
                            <td>{{$text->text_type}}</td>
                            <td>{!! $text->text !!}</td>
                            <td>
                                <a href="{{route('admin.editor.edit', $text->id)}}" class="rounded-circle btn-primary pull-right">
                                    <i class="fa fa-language"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endslot

            @endcomponent

        </div>
    </div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush