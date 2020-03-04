@extends('layouts.admin')

@section('breadcrumb')
    {!! Breadcrumbs::render('admin.editor.edit', $text) !!}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            editing text <b>{!! $text->key_name !!}</b>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => ['admin.text-editor.update', $text->key_name], 'method' => 'PATCH']) !!}

            @if(json_decode($text->option, true)['mentions'] !== null)
                <label for="">Use "@" to use these tags in the text. <br><small>Example; Dear @name, do u like chips.</small></label>
                <br>
                @foreach(json_decode($text->option, true)['mentions'] as $key => $v)
                    <small class="badge badge-warning"><b>{!! '@'.$key !!}</b></small>
                @endforeach
                <br>
                <br>
            @endif

            {{--<div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
                {{--@foreach($languages as $language)--}}
                    {{--<a class="nav-item nav-link "--}}
                       {{--data-toggle="tab"--}}
                       {{--href="#nav-"--}}
                       {{--role="tab">--}}
                        {{--asdasdad--}}
                    {{--</a>--}}
                {{--@endforeach--}}
            {{--</div>--}}

                {{--<div class="tab-content" id="nav-tabContent">--}}
                    {{--@foreach($languages as $language)--}}
                        {{--<div class="tab-pane "--}}
                             {{--id="nav-{{$language->country_code_large}}"--}}
                             {{--role="tabpanel">--}}

                            <div class="form-group">
                                @if($text->text_type == 'richtext')
                                    <textarea class="summernote" name="text" style="border-radius: 0px">{!! $text->text !!}</textarea>
                                @elseif($text->text_type == 'textarea')
                                    <textarea class="form-control" name="text" style="border-radius: 0px">{!! $text->text !!}</textarea>
                                @elseif($text->text_type == 'text')
                                    <input class="form-control" name="text" style="border-radius: 0px" value="{!! $text->text !!}">
                                @endif
                            </div>

                            {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}

                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}

            {{ Form::close() }}

            <hr>

        </div>
    </div>


    {{--{!! $text->text_type !!}--}}
    @if($text->text_type == 'richtext')
        @component('components.rich-textarea-editor', ['option' => $text->options()])
        @endcomponent
    @endif

@endsection

@push('css')

@endpush

@push('scripts')

@endpush
