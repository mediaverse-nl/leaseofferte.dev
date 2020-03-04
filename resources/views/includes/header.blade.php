<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{--{{ config('app.name', 'Laravel') }}--}}
            <img src="/img/leaseofferte-logo.png" alt="" class="img-fluid" style="height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto main-menu-top">
                <li class="nav-item {{request()->is('/') ? 'active' : ''}} {{request()->is('home') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('site.home') }}">home</a>
                </li>
                <li class="nav-item {{request()->is('lease-oplossingen*') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('site.solution.index') }}">lease categorieen</a>
                </li>
                <li class="nav-item {{request()->is('autolease*') ? 'active' : ''}} {{request()->is('operational-lease*') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('site.autolease') }}">autolease</a>
                </li>
                @php
                    $activePages = \App\Page::get();
                @endphp

                <li class="nav-item
                        {{request()->is('info*') ? 'active' : ''}}
                        {{request()->is('info*') ? 'active' : ''}}
                        @foreach($activePages as $x)
                            {{request()->is($x->slug.'*') ? 'active' : ''}}
                        @endforeach
                    ">
                    <a class="nav-link" href="{{ route('site.about') }}">info</a>
                </li>
                <li class="nav-item {{request()->is('contact*') ? 'active' : ''}}">
                    <a class="nav-link " href="{{ route('site.contact.index') }}">contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
