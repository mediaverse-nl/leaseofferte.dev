<div class="profile">
    <div style="height: auto;   margin-bottom: 5px;">
        <img src="/storage/files/shares/team/thumbs/ginger.jpg" style="object-fit: contain ;object-position: 50% 50%;   width: 100%;">
    </div>
    <div style="height: auto;   margin-bottom: 5px;">
        <img src="/storage/files/shares/team/thumbs/dion.jpg" style="object-fit: contain;object-position: 50% 50%;  width: 100%;">
    </div>
    <div style="height: auto;  margin-bottom: 5px;">
        <img src="/storage/files/shares/team/thumbs/danielle.jpg" style="object-fit: contain; object-position: 50% 50%; width: 100%;">
    </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css"/>
    <style>
        .profile{
            width: 100%;
        }
        .profile img{
            border-radius: 4px;
            /*width: 145px !important;*/
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.profile').slick({
            autoplay: true,
            autoplaySpeed: 15000,
            dots: false,
            arrows: false,
            infinite: true,
            speed: 700,
            fade: true,
            cssEase: 'linear',
            centerMode: true
        });
    </script>
@endpush
