@push('css')
    <!-- include summernote css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- include summernote js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
    <script>
        $(document).ready(function(){
            // Define function to open filemanager window
            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            }
            //
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
            }

            $('.summernote').summernote({
                placeholder: "Type anything here...",
                tabsize: 2,
                buttons: {
                    lfm: LFMButton
                },
                colors: [
                    ['black', 'white', 'gray'], //first line of colors
                    ['#009FD6', '#006A8E', '#F78E0C', '#424242', '#6c757d'] //second line of colors
                ],
                toolbar: {!! json_encode(config('summernote')) !!},
                callbacks: {
                    // callback for pasting text only (no formatting)
                    // onPaste: function (e) {
                    //     var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    //     e.preventDefault();
                    //     bufferText = bufferText.replace(/\r?\n/g, '<br>');
                    //     document.execCommand('insertHtml', false, bufferText);
                    // }
                },
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22',  '23', '24', '25','26', '27','28','29','30','31','32','33','34','35', '36', '37','38','39','40','41','42', '43','44','45','46', '47', '48' , '64', '82', '150'],
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

            $('.dropdown-toggle').dropdown()
        });
    </script>
@endpush
