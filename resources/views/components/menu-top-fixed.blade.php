<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{!! route('home') !!}">Fundoe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{!! route('home') !!}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorieen
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categoryMenu as $category)
                            <a class="dropdown-item" href="{!! route('site.category.show', $category->id) !!}">
                                {!! $category->value !!}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            {{--<!-- Right Side Of Navbar -->--}}
            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (!Auth::guest())
                    @if (Auth::user()->admin == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endif
                @endif

                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Inloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registeer</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('auth.panel') }}">
                                <i class="fa-fw fas fa-tachometer-alt"></i>
                                Paneel
                            </a>
                            <a class="dropdown-item" href="{{ route('auth.order.index') }}">
                                <i class="fa-fw fas fa-archive"></i>
                                Bestelling(en)
                            </a>
                            <a class="dropdown-item" href="{{ route('auth.account.edit') }}">
                                <i class="fa-fw fas fa-user"></i>
                                Account
                            </a>
                            <a href="{{ route('logout') }}"
                               class="dropdown-item"
                               onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                <i class="fa-fw fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif

            </ul>

        </div>
    </div>
</nav>