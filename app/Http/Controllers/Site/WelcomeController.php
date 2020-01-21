<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    use SEOTools, SeoManager;

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function __invoke()
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

        return view('site.welcome');
    }
}
