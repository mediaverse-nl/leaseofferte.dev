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

        if (in_array($slug, $this->page->pluck('slug')->toArray())) {
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
        }else{
            //todo SEO redirects
            $oldUrls = [
                '/' => 'index.php',
                'operational-lease' => 'auto-leasen-maak-uw-offerte-operational-lease.php',
                '' => 'offerte-financial-lease-truck-trailer-oplegger.php',
                '' => 'bouwmachine-leasen-lease-offerte-aanvragen.php',
                '' => 'landbouw-machine-leasen-scherpe-leaseofferte.php',
                '' => 'heftrucklease-direct-uw-lease-offerte.php',
                '' => 'leasing-van-apparatuur-lease-offerte-aanvragen.php',
                'autos' => 'autos.php',
                '' => 'aanbiedingen-operational-lease.php',
                '' => 'machine-leasen-equipment-lease.php',
                '' => 'auto-leasen-financial-lease.php',
                '' => 'auto-leasen-operational-lease.php',
                '' => 'maak-offerte-mkb-bedrijfsfinanciering-bij-30-financiers.php',
                'contact' => 'contact.php',
                'werkwijze' => 'werkwijze.php',
                '' => 'deze-objecten-hebben-klanten-bij-leaseofferte-com-geleased.php',
                '' => 'plaats-uw-voorraad.php',
                '' => 'lease-calculator-in-uw-website.php',
                '' => 'handleiding-kopen-of-leasen-van-een-auto.php',
                '' => 'nieuws-leasemaatschappij-leaseofferte-com.php',
                'financial-lease-belgie' => 'financial-lease-belgie.php',
            ];

            if (in_array($slug, $oldUrls)){
                return redirect()->to( array_search($slug, $oldUrls), 301);
            }

            abort(404);
        }
    }
}
