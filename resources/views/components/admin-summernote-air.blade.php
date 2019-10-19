<div id="summernote{!! $id !!}">{!! $slot !!}</div>

@push('js')
    <script>
        $(document).ready(function()
        {
            var el = $( "#summernote{!! $id !!}" );
            // Define function to open filemanager window
            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
            // Define LFM summernote button
            var LFMButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Insert image with filemanager',
                    click: function() {
                        lfm({type: 'file', prefix: '/admin/laravel-filemanager'}, function(lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };

            $(el).summernote({
                airMode: true,
                popover: {
                    air: [
                        ['style', ['style']],
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['link', 'lfm', 'hr']],
                        ['table', ['table']
                    ]
                ]},
                buttons: {
                    lfm: LFMButton
                },
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        bufferText = bufferText.replace(/\r?\n/g, '<br>');
                        document.execCommand('insertHtml', false, bufferText);
                    }
                },
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '24', '36', '48' , '64', '82', '150'],
                hint: {
                    mentions: {!! !empty($option) ? $option : '[]' !!},
                    match: /\B@(\w*)$/,
                    search: function (keyword, callback) {
                        callback($.grep(this.mentions, function (item) {
                            return item.indexOf(keyword) == 0;
                        }));
                    },
                    content: function (item) {
                        return '@' + item;
                    }
                }
            });

            var resetTime;
            // summernote.change
            $(el).on('summernote.change', function(we, contents) {
//                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                clearTimeout(resetTime);
                resetTime = setTimeout(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/api/text-editor-{!! $id !!}',
                        type: 'POST',
                        data: {  text:contents},
                        dataType: 'JSON',
                        success: function (data) {
//                            alert(3);
                        }
                    });
                }, 1500);
            });

            $('.dropdown-toggle').dropdown()
        });
    </script>
@endpush