@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.index') !!}
@endsection

@section('content')

    <!-- DataTables Example -->
    @component('components.datatable')
        @slot('head')
            <th>subject</th>
            <th>description</th>
            <th>value</th>
            <th>action</th>
            <th>model</th>
            {{--<th> </th>--}}
        @endslot
        @slot('table')

            @foreach($notifications as $notif)
                <tr>
                    <td>
                        {!! ($notif->data['subject']) !!}
                    </td>
                    <td>
                        {!! ($notif->data['description']) !!}
                    </td>
                    <td>
                        {!! isset($notif->data['model']['value']) ? $notif->data['model']['value'] : '' !!}
                    </td>
                    <td>
                        {!! ($notif->created_at->format('d-m-y H:i')) !!}
                    </td>
                    <td>
                        {!! ($notif->notifiable_type) !!}
                    </td>

                    {{--<td>--}}
                        {{--                    <a href="{{route('admin.edit', $notifications)}}">--}}
                        {{--<i class="fas fa-edit"></i>--}}
                        {{--</a>--}}
                        {{--<a href="{{route('pdf.downloadInvoice', $notifications)}}">--}}
                        {{--<i class="fas fa-trash"></i>--}}
                        {{--</a>--}}
                    {{--</td>--}}
                </tr>
            @endforeach

        @endslot
    @endcomponent

@endsection

@push('css')
    <style></style>
@endpush

@push('scripts')
    <script></script>
@endpush