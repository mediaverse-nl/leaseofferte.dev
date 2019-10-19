<ul class="navbar-nav ml-auto">

   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">
                Alerts
                <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown" style="width: 350px;">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            @if(count(auth()->user()->unreadNotifications) >= 1)
                @foreach (collect(auth()->user()->unreadNotifications)->take(7)->sortBy('created_at') as $n)
                    <a class="dropdown-item" href="#">
                        @if(str_contains($n->data['subject'], 'Updated'))
                            <span class="text-warning">
                                <strong>
                                    <i class="fa fa-edit fa-fw"></i>{!! $n->data['subject'] !!}
                                </strong>
                            </span>
                            <span class="small float-right text-muted">{!! $n->created_at->format('d-m-Y h:i') !!}</span>
                            <div class="dropdown-message small">{!! $n->data['description'] !!}</div>
                        @elseif(str_contains($n->data['subject'], 'Created'))
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-plus fa-fw"></i>{!! $n->data['subject'] !!}
                                </strong>
                            </span>
                            <span class="small float-right text-muted">{!! $n->created_at->format('d-m-Y h:i') !!}</span>
                            <div class="dropdown-message small">{!! $n->data['description'] !!}</div>
                        @elseif(str_contains($n->data['subject'], 'Deleted'))
                            <span class="text-danger">
                                <strong>
                                    <i class="fa fa-trash fa-fw"></i>{!! $n->data['subject'] !!}
                                </strong>
                            </span>
                            <span class="small float-right text-muted">{!! $n->created_at->format('d-m-Y h:i') !!}</span>
                            <div class="dropdown-message small">{!! $n->data['description'] !!}</div>
                        @else
                            <span class="text-primary">
                                <strong>
                                    <i class="fa fa-info fa-fw"></i>{!! $n->data['subject'] !!}
                                </strong>
                            </span>
                            <span class="small float-right text-muted">{!! $n->created_at->format('d-m-Y h:i') !!}</span>
                            <div class="dropdown-message small">{!! $n->data['description'] !!}</div>
                        @endif
                    </a>
                    @if(!$loop->last)
                        <div class="dropdown-divider"></div>
                    @endif
                @endforeach
            @else
                <span class="text-dark" style="padding: .5rem 1.5rem;">
                    <strong>
                        There are no notification.
                    </strong>
                </span>
                <span class="small float-right text-muted"></span>
                {{--<div class="dropdown-message small" style="padding: .5rem 1.5rem;">sdddd</div>--}}
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="{!! route('admin.notification.index') !!}">View all alerts</a>
        </div>
    </li>
    <li class="nav-item">

        <a href="{{ route('site.home') }}"
           class="nav-link"
           onclick="">
            <i class="fa fa-fw fa-home"></i>
            Terug
        </a>
    </li>
    <li class="nav-item">

        <a href="{{ route('logout') }}"
           class="nav-link"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-sign-out"></i>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>