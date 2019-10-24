<a href="{!! route('admin.editor.edit', $text->id) !!}" data-toggle="tooltip" data-placement="top" title="Edit; {!! $text->key_name !!}" style="
    position: absolute !important;
    color: #cbb956 !important;
    margin-left: -45px !important;
    height: 20px !important;
    width: 20px !important;
    font-size: 11px !important;
    background: none !important;
    text-align: left !important;" class="btn btn-default">
    <button type="button" class="btn btn-success btn-circle"
      style="width: 30px;
      background: #gr;
        height: 30px;
        border: 1px solid white;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;">
        <i class="fa fa-edit"></i>
    </button>
</a>

@component('components.admin-summernote-air', ['id' => $text->id, 'option' => $text->options()])
    {!! $text->text !!}
@endcomponent


