@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.faq.index') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-9">

            @component('components.datatable')
                @slot('head')
                    {{--<th>id</th>--}}
                    <th>title</th>
                    <th class="no-sort"></th>
                @endslot

                @slot('table')
                    @foreach($faqs as $faq)
                        <tr>
                            {{--<td>{{$faq->id}}</td>--}}
                            <td>{{$faq->title}}</td>
                            <td>
                                @component('components.model', [
                                    'id' => 'faqTableBtn'.$faq->id,
                                    'title' => 'Delete',
                                    'actionRoute' => route('admin.faq.destroy', $faq->id),
                                    'btnClass' => 'rounded-circle delete',
                                    'btnIcon' => 'fa fa-trash'
                                ])
                                    @slot('description')
                                        If u proceed u will delete all relations
                                    @endslot
                                @endcomponent
                                <a href="{{route('admin.faq.edit', $faq->id)}}" class="rounded-circle edit">
                                    <i class="fa fa-edit"></i>
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