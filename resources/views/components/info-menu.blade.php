@php
    $Solutions = \App\Page::orderBy('title')->where('options_2', '!=', '0')->get(['title', 'slug']);

    $baseList = [
        [
            'title' => 'Over LEASEOFFERTE.com',
            'slug' => substr(route('site.about', [], false), 1),
            'static' => true,
        ], [
            'title' => 'Nieuws',
            'slug' => substr(route('site.news.index', [], false), 1),
            'static' => true,
        ]
    ];

    $Solutions = array_merge(collect($Solutions)->toArray(), $baseList);

    $title = array_column($Solutions, 'title');

    array_multisort($title, SORT_ASC, $Solutions);

@endphp

<div class="col-md-3" style="margin-bottom: 150px;">
    <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -100px !important;">
        <div class="card-body" style="">
            <span class="h1" style="color:#006A8E;">
                menu
            </span>
        </div>
        <ul class="list-group list-group-flush" style="padding: 0px;">
{{--            {!! dd($Solutions) !!}--}}
            @foreach($Solutions as $s)
                <li class="list-group-item {{request()->is($s['slug'].(isset($s['static']) ? '' : '*')) ? 'active' : ''}}">
                    <a href="{!! route('site.page.show', $s['slug']) !!}" >
                        <i class="fas fa-chevron-right"></i>
                        {!! ucfirst($s['title']) !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@push('css')
    <style>
        .list-group.list-group-flush > .list-group-item.active a{
            color: white !important;
            font-weight: bold;
        }
        .list-group.list-group-flush > .list-group-item a{
            color: #6c757d !important;
        }
        .list-group {
            padding-left: 0px !important;
        }
        .list-group.list-group-flush > .list-group-item.active{
            background: #009FD6 !important;
        }

    </style>
@endpush
