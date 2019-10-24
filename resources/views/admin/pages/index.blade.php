@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.pages.index') !!}
@endsection

@section('content')

    @component('components.datatable')
        @slot('head')
            <th>id</th>
            <th>title</th>
            <th>live</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th class="no-sort"></th>
        @endslot
        @slot('table')
            @foreach($pages as $page)
                <tr class="{!! $page->trashed() ? 'table-danger' : '' !!}">
                    <td>{!! $page->id !!}</td>
                    <td>{!! $page->title !!}</td>
                    <td>{!! $page->trashed() ? 'offline' : 'live'!!}</td>
                    <td>{!! $page->created_at->format('d-m-Y H:i') !!}</td>
                    <td>{!! $page->updated_at->format('d-m-Y H:i') !!}</td>
                    <td>
                        @component('components.model', [
                                   'id' => 'userTableBtn'.$page->id,
                                   'title' => ($page->trashed() ? 'Restore' : 'Delete').' entry '.$page->id,
                                   'actionRoute' => route('admin.pages.destroy', $page->id),
                                   'btnClass' => 'rounded-circle delete',
                                   'btnIcon' => 'fa '.($page->trashed() ? 'fa-undo' : 'fa-trash')
                               ])
                            @slot('description')
                                If u proceed u will <b>{!! $page->trashed() ? 'restore' : 'delete' !!}</b> all relations
                            @endslot
                        @endcomponent
                        <a href="{{route('admin.pages.edit', $page->id)}}" class="rounded-circle edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent



    {{--{!! $categories !!}--}}
    {{--{!! $category->renderMenu() !!}--}}

    {{--<ul id="sortable">--}}
        {{--<li id="itemddd" ondrag="log('dd')">bla 3</li>--}}
        {{--<li id="item_2">bla 2</li>--}}
        {{--<li id="item_3">bla 1</li>--}}
    {{--</ul>--}}

    {{--<ul class="example">--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>--}}
        {{--<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>--}}
    {{--</ul>--}}

    {{--<ol class="limited_drop_targets vertical">--}}
        {{--<li class="highlight">Item 1</li>--}}
        {{--<li>Item 4</li>--}}
        {{--<li class="highlight">Item 5</li>--}}
        {{--<li>Item 6</li>--}}
        {{--<li class="" style="">Item 2</li>--}}
        {{--<li class="highlight" style="">Item 3</li>--}}
    {{--</ol>--}}
    {{--<input value="test" />--}}
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