@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.seo-manager.index') !!}
@endsection

@section('content')

    <!-- DataTables Example -->
    @component('components.datatable')
        @slot('head')
            <th>page</th>
            <th>title</th>
            <th>Opties</th>
        @endslot
        @slot('table')
            @foreach($seo as $i)
                <tr>
                    <td>{!! route($i->route_name) !!}</td>
                    <td>{!! $i->title ? $i->title : 'leeg' !!}</td>
                    <td>
                        <a href="{{route('admin.seo-manager.edit', $i->id)}}" class="rounded-circle edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush
