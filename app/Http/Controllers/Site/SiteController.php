<?php

namespace App\Http\Controllers\Site;

use App\Faq;
use Illuminate\Http\Request;

use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    use SEOTools, SeoManager;

    public function terms()
    {
        //default seo
        $this->seo()
            ->setTitle($this->getPageSeo()->title)
            ->setDescription($this->getPageSeo()->description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter();

        return view('site.terms');
    }

    public function policy()
    {
        //default seo
        $this->seo()
            ->setTitle($this->getPageSeo()->title)
            ->setDescription($this->getPageSeo()->description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter();

        return view('site.policy');
    }

    public function about()
    {
        //default seo
        $this->seo()
            ->setTitle($this->getPageSeo()->title)
            ->setDescription($this->getPageSeo()->description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter();

        return view('site.about');
    }

    public function faq()
    {
        //default seo
        $this->seo()
            ->setTitle($this->getPageSeo()->title)
            ->setDescription($this->getPageSeo()->description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter();

        $faq = new Faq;

        $faqs = $faq->get();

        return view('site.faq')
            ->with('faqs', $faqs);
    }
}
