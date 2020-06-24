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
                'lease-oplossingen?category=8' => 'auto-leasen-maak-uw-offerte-operational-lease.php',
                'lease-oplossingen?category=3' => 'offerte-financial-lease-truck-trailer-oplegger.php',
                'lease-oplossingen?category=14' => 'bouwmachine-leasen-lease-offerte-aanvragen.php',
                'lease-oplossingen?category=4' => 'landbouw-machine-leasen-scherpe-leaseofferte.php',
                'lease-oplossingen?category=10' => 'heftrucklease-direct-uw-lease-offerte.php',
                'lease-oplossingen?category=7' => 'leasing-van-apparatuur-lease-offerte-aanvragen.php',
                'lease-oplossingen?category=1' => 'machine-metaal-hout-plastic-verwerking-leasen.php',
                'lease-oplossingen?category=12' => 'recyclingmachine-afvalpers-balenpers-leasen.php',
                'lease-oplossingen?category=9' => 'bakoven-en-voedingsmiddelen-apparatuur-leasen.php',
                'machine-leasen-equipment-lease' => 'machine-leasen-equipment-lease.php',
                'autos' => 'autos.php',
                'lease-oplossingen-truck-vrachtwagen/28' => 'trucks.php',
                'operational-lease' => 'aanbiedingen-operational-lease.php',
                'autolease' => 'auto-leasen-financial-lease.php',
                'operational-lease' => 'auto-leasen-operational-lease.php',
                'info' => 'maak-offerte-mkb-bedrijfsfinanciering-bij-30-financiers.php',
                'contact' => 'contact.php',
                'info' => 'werkwijze.php',
                'info' => 'deze-objecten-hebben-klanten-bij-leaseofferte-com-geleased.php',
                'info' => 'plaats-uw-voorraad.php',
                'financial-lease-calculator-in-uw-eigen-website' => 'lease-calculator-in-uw-website.php',
                'handleiding-met-tips-voor-auto-kopen-leasen-of-inruilen' => 'handleiding-kopen-of-leasen-van-een-auto.php',
                'info/nieuws' => 'nieuws-leasemaatschappij-leaseofferte-com.php',
                'financial-lease-belgie' => 'financial-lease-belgie.php',
                'lease-oplossingen-aanhanger/24' => 'aanhangwagen-leasen.php',
                'lease-oplossingen-heftruck/75' => 'heftruck-reachtruck-pallettruck-leasen.php',
                'lease-oplossingen-tractor/39' => 'tractor-leasen-landbouwapparatuur-leasen.php',
                'lease-oplossingen-truck-vrachtwagen/28' => 'vrachtwagen-leasen.php',
                'lease-oplossingen-autobus-touringcar/94' => 'touringcar-bus-stadsbus-leasen.php',
                'lease-oplossingen-binnenvaartschip/106' => 'binnenvaartschip-scheepvaart-leasen.php',
                'lease-oplossingen-verkoopwagen-marktwagen/29' => 'verkoopwagen-marktwagen-leasen.php',
                'lease-oplossingen-graafmachine/11' => 'graafmachine-leasen.php',
                'lease-oplossingen-oplegger-trailer/23' => 'oplegger-leasen.php',
                'lease-oplossingen-verreiker/20' => 'verreiker-leasen.php',
                'lease-oplossingen-bulldozer/13' => 'bulldozer-leasen.php',
                'lease-oplossingen-dumper-kipper/17' => 'kipper-leasen.php',
                'lease-oplossingen-reinigingsmachine-veegmachine/87' => 'veegwagen-leasen.php',
                'lease-oplossingen-hoogwerker/108' => 'hoogwerker-leasen.php',
                'lease-oplossingen-shredder-machine/89' => 'shredder-of-andere-recyclingmachine-leasen.php',
                'lease-oplossingen-medische-apparatuur-leasen/7' => 'medische-apparatuur-leasen.php',
                'lease-oplossingen-betonmixer/12' => 'betonmixer-cementmixer-bouwmachine-leasen.php',
                'lease-oplossingen-hijskraan-torenkraan/16' => 'mobiele-hijskraan-leasen.php',
            ];

            if (in_array($slug, $oldUrls)){
                return redirect()->to( array_search($slug, $oldUrls), 301);
            }

            abort(404);
        }
    }
}
