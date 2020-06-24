<div id="thediv" class="reveal-open" style="position: relative;" >
    <div id="textContainer">
        @php
            $readableText = $description;
            if(isset($data)){
                foreach (collect($data)->toArray() as $key => $v){
                    $readableText = str_replace('@'.$key, $v, $readableText);
                }
            }
        @endphp
        {!! $readableText !!}
    </div>
    <br>
    <br>
    <div class="lock-fade">
        <div class="fadeout"></div>
    </div>
</div>
<a id="more" class="btn btn-default d-none" style="color: white; margin-top: 20px;">lees meer...</a>
<a id="less" class="btn btn-default d-none" style="position: relative; z-index: 9999 !important; color: white; margin-top: -20px !important;">lees minder</a>

@push('js')
    <script src="/js/collapse-text.js"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="/css/collapse-text.css">
@endpush
