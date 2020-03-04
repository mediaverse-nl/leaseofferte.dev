@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.portfolio.index') !!}
@endsection

@section('content')

    @component('components.datatable')
        @slot('head')
            <th>id</th>
            <th>title</th>
            <th>location</th>
            <th>branch</th>
            <th class="no-sort"></th>
        @endslot
        @slot('table')
            @foreach($portfolios as $portfolio)
                <tr class="">
                    <td>{!! $portfolio->id !!}</td>
                    <td>{!! $portfolio->title !!}</td>
                    <td>{!! $portfolio->location !!}</td>
                    <td>{!! $portfolio->solution ? $portfolio->solution->category->value : 'not selected' !!}</td>
                    <td>
                        @component('components.model', [
                               'id' => 'userTableBtn'.$portfolio->id,
                               'title' => 'Delete entry '.$portfolio->id,
                               'actionRoute' => route('admin.portfolio.destroy', $portfolio->id),
                               'btnClass' => 'rounded-circle delete',
                               'btnIcon' => 'fa fa-trash'
                            ])
                            @slot('description')
                                If u proceed u will <b>delete</b> all relations
                            @endslot
                        @endcomponent
                        <a href="{{route('admin.portfolio.edit', $portfolio->id)}}" class="rounded-circle edit">
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
