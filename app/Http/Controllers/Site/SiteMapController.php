<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SiteMapController extends Controller
{
    public function __invoke()
    {
//        return public_path('sitemap.xml');
        return SitemapGenerator::create('https://mediaverse-dev.nl')
            ->writeToFile(public_path('sitemap.xml'), 'sitemap.xml');
    }
}
