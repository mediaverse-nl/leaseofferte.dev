<?php

namespace App\Http\Controllers\Site;

use App\Page;
use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    use SEOTools, SeoManager;

    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function show($slug)
    {
        $templates = [
            'default-page',
        ];

        $urls = [
            'default-page',
        ];

        if (in_array($slug, $this->page->pluck('slug')->toArray()))
        {
            $page = $this->page->where('slug', '=', $slug)->first();

            //default seo
            $this->seo()
                ->setTitle($page->meta_title)
                ->setDescription($page->meta_description);
            //opengraph
            $this->seo()
                ->opengraph()
                ->setTitle($page->meta_title)
                ->setUrl(url()->current())
                ->addProperty('type', 'website');
            //twitter
            $this->seo()
                ->twitter()
                ->setTitle($page->meta_title)
                ->setSite('@username');

            $template = 'default-page';


            return view('site.templates.'.$template, compact('page'));
        }
//        exit;
//        return 'asdasd';
    }
}
