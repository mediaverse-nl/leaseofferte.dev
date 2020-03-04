@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.news.index') !!}
@endsection

@section('content')

    @component('components.datatable')
        @slot('head')
            <th>id</th>
            <th>title</th>
            <th class="no-sort"></th>
        @endslot
        @slot('table')
            @foreach($news as $i)
                <tr class="">
                    <td>{!! $i->id !!}</td>
                    <td>{!! $i->title !!}</td>
                     <td>
                        @component('components.model', [
                               'id' => 'userTableBtn'.$i->id,
                               'title' => 'Delete entry '.$i->id,
                               'actionRoute' => route('admin.news.destroy', $i->id),
                               'btnClass' => 'rounded-circle delete',
                               'btnIcon' => 'fa fa-trash'
                            ])
                            @slot('description')
                                If u proceed u will <b>delete</b> all relations
                            @endslot
                        @endcomponent
                        <a href="{{route('admin.news.edit', $i->id)}}" class="rounded-circle edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    </style>
@endpush

@push('scripts')
    {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    </script>
@endpush
