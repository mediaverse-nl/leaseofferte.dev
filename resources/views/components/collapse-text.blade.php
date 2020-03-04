<div id="thediv" class="reveal-open" style="position: relative;" >
    <div id="textContainer">
        {!! $description !!}
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
    <script>

        $(document).ready(function() {

            $('#less').toggleClass("show").toggleClass("d-none");

            moreLessText();
            $("#more, #less").click(function() {
                moreLessText();
                topFunction();
            });

            function topFunction() {
                var docHeight = $( document ).height()
                var btnHeight = $("#more").offset().top

                if(btnHeight != 0){
                    document.body.scrollTop = docHeight -  btnHeight;
                    document.documentElement.scrollTop = docHeight -  btnHeight;
                }
            }

            function moreLessText() {
                $("#thediv").toggleClass("reveal-closed").toggleClass("reveal-open");
                $('#more, #less').toggleClass("show").toggleClass("d-none")
            }

            setTimeout(function () {
                var height = $('#textContainer').height();
                if(height <= 500){
                    moreLessText();
                    $("#more, #less").remove();
                    $(".fadeout").remove();
                }
            }, 100);
        });
    </script>
@endpush

@push('css')
    <style>
        #thediv{
            position: relative;
        }

        .lock-fade{
            width: 100%;
            height: 0px;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .fadeout {
            position: relative;
            bottom: 5em;
            height: 5em;
            background: -webkit-linear-gradient(
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 100%
            );
            background-image: -moz-linear-gradient(
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 100%
            );
            background-image: -o-linear-gradient(
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 100%
            );
            background-image: linear-gradient(
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 100%
            );
            background-image: -ms-linear-gradient(
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 1) 100%
            );
        }

        .reveal-open {
            overflow: auto;
            height: auto;
        }

        .reveal-closed {
            overflow: hidden;
            position: relative;
            height: 500px;
        }
    </style>
@endpush
