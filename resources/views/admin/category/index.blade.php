@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.index') !!}
@endsection

@section('content')

    @component('components.datatable')
        @slot('head')
            <th>id</th>
            <th>titel</th>
            <th>rates</th>
            <th class="no-sort"></th>
        @endslot
        @slot('table')
            @foreach($categories as $category)
                <tr class="{!! $category->trashed() ? 'table-danger' : '' !!}">
                    <td>{!! $category->id !!}</td>
                    <td>{!! $category->value !!}</td>
                    <td>
                        @foreach(explode(',', $category->interest_rate) as $interst)
                            <span class="badge badge-info">{!! $interst !!}</span>
                        @endforeach
                    </td>
                    <td>
                        @component('components.model', [
                               'id' => 'userTableBtn'.$category->id,
                               'title' => ($category->trashed() ? 'Restore' : 'Delete').' entry '.$category->id,
                               'actionRoute' => route('admin.category.destroy', $category->id),
                               'btnClass' => 'rounded-circle delete',
                               'btnIcon' => 'fa '.($category->trashed() ? 'fa-undo' : 'fa-trash')
                           ])
                            @slot('description')
                                If u proceed u will <b>{!! $category->trashed() ? 'restore' : 'delete' !!}</b> all relations
                            @endslot
                        @endcomponent
                        <a href="{{route('admin.category.edit', $category->id)}}" class="rounded-circle edit">
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
