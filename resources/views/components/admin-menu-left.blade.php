<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

    <li class="nav-item {{request()->is('admin/dashboard') ? 'active' : ''}} {{request()->is('admin') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.dashboard')}}" >
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>

    {{--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">--}}
        {{--<a class="nav-link nav-link-collapse {{Requests::is('admin/activity*') ? '' : 'collapsed'}}" data-toggle="collapse" href="#activityComponents" data-parent="#exampleAccordion" aria-expanded="false">--}}
            {{--<i class="fa fa-fw fa-trophy"></i>--}}
            {{--<span class="nav-link-text">Activity</span>--}}
        {{--</a>--}}
        {{--<ul class="sidenav-second-level collapse {{Requests::is('admin/activity*') ? 'show' : ''}}" id="activityComponents" style="">--}}
            {{--<li class="{{Requests::is('admin/activity/create') ? '' : (Requests::is('admin/activity*') ? 'active' : '')}}">--}}
                {{--<a href="{{route('admin.activity.index')}}">--}}
                    {{--<i class="fa fa-fw fa-list"></i>--}}
                    {{--<span class="nav-link-text">index</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="{{Requests::is('admin/activity/create') ? 'active' : ''}}">--}}
                {{--<a href="{{route('admin.activity.create')}}">--}}
                    {{--<i class="fa fa-fw fa-plus"></i>--}}
                    {{--<span class="nav-link-text">create</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">
        <a class="nav-link nav-link-collapse {{request()->is('admin/pages*') ? '' : 'collapsed'}}" data-toggle="collapse" href="#pagesComponents" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-align-left"></i>
            <span class="nav-link-text">Pages</span>
        </a>
        <ul class="sidenav-second-level collapse {{request()->is('admin/pages*') ? 'show' : ''}}" id="pagesComponents" style="">
            <li class="{{request()->is('admin/pages/create') ? '' : (request()->is('admin/pages*') ? 'active' : '')}}">
                <a href="{{route('admin.pages.index')}}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">index</span>
                </a>
            </li>
            <li class="{{request()->is('admin/pages/create') ? 'active' : ''}}">
                <a href="{{route('admin.pages.create')}}">
                    <i class="fa fa-fw fa-plus"></i>
                    <span class="nav-link-text">create</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">
        <a class="nav-link nav-link-collapse {{request()->is('admin/category*') ? '' : 'collapsed'}}" data-toggle="collapse" href="#categoryComponents" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Category</span>
        </a>
        <ul class="sidenav-second-level collapse {{request()->is('admin/category*') ? 'show' : ''}}" id="categoryComponents" style="">
            <li class="{{request()->is('admin/category/create') ? '' : (request()->is('admin/category*') ? 'active' : '')}}">
                <a href="{{route('admin.category.index')}}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">index</span>
                </a>
            </li>
            <li class="{{request()->is('admin/category/create') ? 'active' : ''}}">
                <a href="{{route('admin.category.create')}}">
                    <i class="fa fa-fw fa-plus"></i>
                    <span class="nav-link-text">create</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">
        <a class="nav-link nav-link-collapse {{request()->is('admin/solution*') ? '' : 'collapsed'}}" data-toggle="collapse" href="#solutionComponents" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-cube"></i>
            <span class="nav-link-text">Objects</span>
        </a>
        <ul class="sidenav-second-level collapse {{request()->is('admin/solution*') ? 'show' : ''}}" id="solutionComponents" style="">
            <li class="{{request()->is('admin/solution/create') ? '' : (request()->is('admin/solution*') ? 'active' : '')}}">
                <a href="{{route('admin.solution.index')}}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">index</span>
                </a>
            </li>
            <li class="{{request()->is('admin/solution/create') ? 'active' : ''}}">
                <a href="{{route('admin.solution.create')}}">
                    <i class="fa fa-fw fa-plus"></i>
                    <span class="nav-link-text">create</span>
                </a>
            </li>
        </ul>
    </li>




    <li class="nav-item {{request()->is('admin/seo-manager*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.seo-manager.index')}}">
            <i class="fa fa-fw fa-search"></i>
            <span class="nav-link-text">SEO</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('admin/file-manager*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.file-manager.index')}}">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Images</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('admin/editor*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.editor.index')}}">
            <i class="fa fa-fw fa-align-left"></i>
            <span class="nav-link-text">Text</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">
        <a class="nav-link nav-link-collapse {{request()->is('admin/faq*') ? '' : 'collapsed'}}" data-toggle="collapse" href="#faqComponents" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-question"></i>
            <span class="nav-link-text">FAQ</span>
        </a>
        <ul class="sidenav-second-level collapse {{request()->is('admin/faq*') ? 'show' : ''}}" id="faqComponents" style="">
            <li class="{{request()->is('admin/faq/create') ? '' : (request()->is('admin/faq*') ? 'active' : '')}}">
                <a href="{{route('admin.faq.index')}}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">index</span>
                </a>
            </li>
            <li class="{{request()->is('admin/faq/create') ? 'active' : ''}}">
                <a href="{{route('admin.faq.create')}}">
                    <i class="fa fa-fw fa-plus"></i>
                    <span class="nav-link-text">create</span>
                </a>
            </li>
        </ul>
    </li>
</ul>

<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
        </a>
    </li>
</ul>
