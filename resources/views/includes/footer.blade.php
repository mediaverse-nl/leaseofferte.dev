<footer id="sticky-footer" class="text-white-50">
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left" style="background: #006A8E; padding: 50px 0;">

        <div class="container light">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3 py-4">
                    <!-- Links -->
                    <h5 class="text-uppercase">algemeen</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="{!! route('site.home') !!}">Home</a>
                        </li>
                        <li>
                            <a href="{!! route('site.solution.index') !!}">Lease Categorieën</a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="#!">Voordelen</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{!! route('site.about') !!}">Over Leaseofferte</a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="#!">Referenties</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{!! route('site.faq') !!}">FAQ</a>
                        </li>
                        <li>
                            <a href="{!! route('site.contact.index') !!}">Contact</a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="{!! route('site.policy') !!}">disclaimer</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{!! route('site.terms') !!}">Algemene Voorwaarden</a>
                        </li>
                        <li>
                            <a href="{!! route('site.privacy') !!}">Privacy Statement & Disclaimer</a>
                        </li>
                    </ul>

                </div>

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3 py-4">

                    <!-- Links -->
                    <h5 class="text-uppercase">contactgegevens</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="https://www.google.com/maps/place/Hoofdveste+32B,+3992+DG+Houten/@52.0255057,5.1388494,17z/data=!3m1!4b1!4m5!3m4!1s0x47c66691ce260843:0xc1c3e19893f5dcde!8m2!3d52.0255057!4d5.1410381">
                                Hoofdveste 32b <br>
                                3992 DG Houten
                            </a>
                        </li>
                        <li>
                            <br>
                            <a>IBAN: NL44 ABNA 0506 6991 53</a>
                        </li>
                        <li>
                            <a>KvK: 30220695</a>
                        </li>
                        <li>
                            <a>BTW: NL8173.47.811B01</a>
                        </li>
                        <li>
                            <br>
                            <b><a href="mailto:aanvragen@leaseofferte.com">aanvragen@leaseofferte.com</a></b>
                        </li>
                        <li>
                            <b><a href="tel:+31 (0) 30 227 16 19">+31 (0) 30 227 16 19 </a></b>
                        </li>
                        <li>
                            <br>
                            <!-- Facebook -->
                            <a class="fb-ic" href="https://www.facebook.com/leaseofferte/">
                                <i class="fab fa-facebook-f white-text mr-4"> </i>
                            </a>
                            <!--Linkedin -->
                            <a class="li-ic" href="https://www.linkedin.com/company/leaseofferte.com/">
                                <i class="fab fa-linkedin-in white-text mr-4"> </i>
                            </a>
                            <!--Instagram-->
                            <a class="ins-ic" href="https://www.instagram.com/leaseofferte/">
                                <i class="fab fa-instagram white-text"> </i>
                            </a>
                        </li>
                    </ul>

                </div>

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        <video class="embed-responsive-item" poster="/img/video-thumbnail.jpg" width="320" height="240" controls controlsList="nodownload">
                            <source src="/video/LEASEOFFERTE.com - FINANCIAL LEASE.mp4" type="video/mp4">
                            <source src="/video/LEASEOFFERTE.com - FINANCIAL LEASE.mp4" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
{{--                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/k6OpkHFBhIM?loop=1&modestbranding=1" width=560 height=315 frameborder=0 allowfullscreen>--}}
{{--                        </iframe>--}}
                    </div>
                </div>
                <!-- Grid column -->
            </div>
        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left" style="background: #D9E9EE; padding: 0px 0;">
        <div class="container blue py-4" >
            <!-- Grid row -->
            @php
                $ftrSolutions = \App\Category::has('solutions')->orderBy('value')->get();
                 $ftrObjs = \App\LeaseOffer::groupBy('merk')->orderBy('merk')->get();
                $ftrPages = \App\Page::where('options', '=', 1)->get();
            @endphp
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 mx-auto">
                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">info pagina's</h5>

                    <ul class="list-unstyled">
                        @foreach($ftrPages as $ftrPage)
                            <li>
                                <a href="{!! route('site.page.show', $ftrPage->slug)  !!}">{!! ($ftrPage->title) !!}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                @foreach($ftrObjs->chunk($ftrObjs->count() / 1) as $ftrObjGroup)
                    <!-- Grid column -->
                    <div class="col-md-3 mx-auto">
                        <!-- Links -->
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">operational lease</h5>

                        <ul class="list-unstyled">
                            @foreach($ftrObjGroup as $ftrObj)
                                <li>
                                    <a href="{!! route('site.offer.index')."?brands[]=".$ftrObj->merk  !!}">{!! ($ftrObj->merk) !!}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <hr class="clearfix w-100 d-md-none">
                @endforeach

                @foreach($ftrSolutions->chunk(ceil($ftrSolutions->count() / 2), true) as $ftrCateGroup)
                    <!-- Grid column -->
                    <div class="col-md-3 mx-auto">
                        <!-- Links -->
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Lease Categorieen</h5>

                        <ul class="list-unstyled">
                            @foreach($ftrCateGroup as $ftrCate)
                                <li>
                                    <a href="{!! route('site.solution.index', ['category' => $ftrCate->id]) !!}">{!! ($ftrCate->value) !!}</a>
                                 </li>
                            @endforeach
                        </ul>

                    </div>

                    <hr class="clearfix w-100 d-md-none">
                @endforeach

            </div>
        </div>
        <div class="container blue">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-4" style="">© {!! date('Y') !!} Copyright:
                <a href="{!! url('/') !!}"> <b>Leaseofferte.com</b></a>
            </div>
        </div>
    </div>
    <!-- Copyright -->
</footer>
