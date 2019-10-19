@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.category.index') !!}
@endsection

@section('content')

    @component('components.datatable')
        @slot('head')
            <th>id</th>
            <th>titel</th>
            <th>category</th>
            <th class="no-sort"></th>
        @endslot
        @slot('table')
            @foreach($solutions as $solution)
                <tr class="">
                    <td>{!! $solution->id !!}</td>
                    <td>{!! $solution->title !!}</td>
                    <td>{!! $solution->category->value !!}</td>
                    <td>
                        @component('components.model', [
                                   'id' => 'userTableBtn'.$solution->id,
                                   'title' => 'Delete entry '.$solution->id,
                                   'actionRoute' => route('admin.category.destroy', $solution->id),
                                   'btnClass' => 'rounded-circle delete',
                                   'btnIcon' => 'fa fa-trash'
                               ])
                            @slot('description')
                                If u proceed u will <b>delete</b> all relations
                            @endslot
                        @endcomponent
                        <a href="{{route('admin.solution.edit', $solution->id)}}" class="rounded-circle edit">
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

        /*body.dragging, body.dragging * {*/
            /*cursor: move !important;*/
        /*}*/

        /*.dragged {*/
            /*position: absolute;*/
            /*opacity: 0.5;*/
            /*z-index: 2000;*/
        /*}*/

        /*ol.example li.placeholder {*/
            /*position: relative;*/
            /*!** More li styles **!*/
        /*}*/
        /*ol.example li.placeholder:before {*/
            /*position: absolute;*/
            /*!** Define arrowhead **!*/
        /*}*/
    </style>
@endpush

@push('scripts')
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

//    $(document).ready(function(){
////        alert('dddd');
//
//        $('#sortable').sortable({
//            tolerance: 'touch',
//            drop: function () {
//                alert('delete!');
//            }
//        });
////        $( "#sortable" ).disableSelection();
//
////        $('#item').sortable();
//
//        $( "#itemddd" ).on( "change", function () {
//            alert('dddd');
//            log('ddd');
//
//        });
//
//
////        log('ddd');
//
//        var group = $("ol.limited_drop_targets").sortable({
//            group: 'limited_drop_targets',
//            isValidTarget: function  ($item, container) {
//                log('ddd');
//                if($item.is(".highlight"))
//                    return true;
//                else
//                    return $item.parent("ol")[0] == container.el[0];
//            },
//            onDrop: function ($item, container, _super) {
//                log('ccc');
//
//                $('#serialize_output').text(
//                    group.sortable("serialize").get().join("\n"));
//                _super($item, container);
//            },
//            serialize: function (parent, children, isContainer) {
//                log('aaa');
//
//                return isContainer ? children.join() : parent.text();
//            },
//            tolerance: 6,
//            distance: 10
//        });
//
//        function log(str) {
//            return console.log(str);
//        }
//
////        $(".dd-list").sortable({
////
////            afterMove: function ($placeholder, container, $closestItemOrContainer) {
////                log('ddd');
////            }
//
//
////            containerSelector: 'tr',
////            itemSelector: 'th',
////            placeholder: '<th class="placeholder"/>',
////            vertical: false,
////            onDragStart: function ($item, container, _super) {
////                log('ddd');
////                oldIndex = $item.index();
////                $item.appendTo($item.parent());
////                _super($item, container);
////            },
////            onDrop: function  ($item, container, _super) {
////                log('ddd');
////
//////                var field,
//////                    newIndex = $item.index();
//////
//////                if(newIndex != oldIndex) {
//////                    $item.closest('table').find('tbody tr').each(function (i, row) {
//////                        row = $(row);
//////                        if(newIndex < oldIndex) {
//////                            row.children().eq(newIndex).before(row.children()[oldIndex]);
//////                        } else if (newIndex > oldIndex) {
//////                            row.children().eq(newIndex).after(row.children()[oldIndex]);
//////                        }
//////                    });
//////                }
//////
//////                _super($item, container);
////            }
////        });
//
//
//        $('.ui-sortable-handle').on('change', function() {
//            /* on change event */
//            console.log('test')
//        });
//        $('.ui-sortable').on('change', function() {
//            /* on change event */
//            console.log('test')
//        });
//        $('.ui-sortable-handle').change(function() {
//            /* on change event */
//            console.log('test')
//        });
//
//        $('.ui-sortable').change(function() {
//            /* on change event */
//            console.log('test')
//        });
//
//    });


            {{--// $(function () {--}}
            {{--$("#example").sortable({--}}
                {{--group: 'no-drop',--}}

            {{--});--}}
            {{--// });--}}
            {{--dropCallback: function(details) {--}}

            {{--var order = new Array();--}}
            {{--$("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {--}}
            {{--order[index] = $(elem).attr('data-id');--}}
            {{--});--}}
            {{--if (order.length === 0){--}}
            {{--var rootOrder = new Array();--}}
            {{--$("#nestable > ol > li").each(function(index,elem) {--}}
            {{--rootOrder[index] = $(elem).attr('data-id');--}}
            {{--});--}}
            {{--}--}}
            {{--$.post('{{url("admin/menu/")}}',--}}
            {{--{ source : details.sourceId,--}}
            {{--destination: details.destId,--}}
            {{--order:JSON.stringify(order),--}}
            {{--rootOrder:JSON.stringify(rootOrder)--}}
            {{--},--}}
            {{--function(data) {--}}
            {{--// console.log('data '+data);--}}
            {{--})--}}
            {{--.done(function() {--}}
                {{--$( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();--}}
            {{--})--}}
            {{--.fail(function() {  })--}}
            {{--.always(function() {  });--}}
            {{--}--}}
            {{--});--}}
            {{--$('.delete_toggle').each(function(index,elem) {--}}
                {{--$(elem).click(function(e){--}}
                    {{--e.preventDefault();--}}
                    {{--$('#postvalue').attr('value',$(elem).attr('rel'));--}}
                    {{--$('#deleteModal').modal('toggle');--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    </script>
@endpush