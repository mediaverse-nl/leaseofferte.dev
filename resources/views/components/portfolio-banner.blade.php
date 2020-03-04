@php
    $portfolioBanner = \App\Portfolio::inRandomOrder()
        ->limit(30)
        ->get();
@endphp

<div style="background: #D9E9EE; ">
    <div class="container py-5">
        <h3 class="text-center" style="font-size:32px; color:#006A8E;">Deze objecten hebben klanten bij LEASEOFFERTE.com geleased</h3>
        <br>
        <div id="portfolioSlider" style="width: 100% !important;">
            @foreach($portfolioBanner as $i)
                <div style="padding: 1rem; ">
                    <div class="card" style="border: none !important;">
                        <div class="card-body">
                            <p class="h6 text-center font-weight-bold" style="color:#006A8E; height: 30px;">{!! $i->title !!}</p>
                            <p class="text-center">
                                <small class="text-muted">verzorgd door LEASEOFFERTE.com</small>
                            </p>
                            <img src="{!! $i->image !!}" alt="" style="height: 160px; width: 100%; object-fit: cover;">
                            <p class=" text-center" style="padding: 5px 5px; color: #6c757d;">
                               <small>
                                   <i class="fas fa-briefcase"></i> {!! $i->branch !!} <br>
                                    <i class="fas fa-map-marker-alt"></i> {!! $i->location !!}
                               </small>
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        .slick-slide {
            outline: none
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('#portfolioSlider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 800,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
@endpush
