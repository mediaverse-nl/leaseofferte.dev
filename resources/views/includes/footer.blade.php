<footer id="sticky-footer" class="py-4 bg-dark text-white-50">
    <div class="container text-center">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">Footer Content</h5>
                    <p>Here you can use rows and columns to organize your footer content.</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="{!! route('site.home') !!}">Home</a>
                        </li>
                        <li>
                            <a href="{!! route('site.solution.index') !!}">Lease Oplossingen</a>
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
                        {{--<li>--}}
                            <a href="{!! route('site.faq') !!}">FAQ</a>
                        {{--</li>--}}
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
                            <a href="{!! route('site.privacy') !!}">Privacy Policy</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            straat
                        </li>
                        <li>
                            postcode + stad
                        </li>
                        <li>
                            kvk
                        </li>
                        <li>
                            btw
                        </li>
                        <li>
                            email
                        </li>
                        <li>
                            telefoon
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© {!! date('Y') !!} Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/"> Leaseofferte.com</a>
        </div>
        <!-- Copyright -->
    </div>
</footer>
