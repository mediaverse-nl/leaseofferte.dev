<?php

namespace App\Http\Controllers\Site;

use App\LeaseOffer;
use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LeaseOfferController extends Controller
{
    use SEOTools, SeoManager;

    protected $offer;

    public function __construct(LeaseOffer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = collect(request()->query)->toArray();

        $queryWithOutFilter = array_except($query, ['filter']);

        if (!Input::has('filter') && !empty($queryWithOutFilter)){
            $encrypted = Crypt::encryptString(json_encode($query));
            return redirect(route('site.offer.index').'?filter='.$encrypted);
        }

        if (Input::has('filter') ){
            try {
                $decrypted = Crypt::decryptString(Input::get('filter'));
            } catch (DecryptException $e) {
                return redirect(route('site.offer.index'));
            }
            $filter = json_decode($decrypted, true);
            if (empty(array_filter($filter))) {
                return redirect(route('site.offer.index'));
            }
        }else{
            $filter = [];
        }

        $offers = $this->offer
            ->whereHas('operationalLeasePrices', function ($q) use ($filter){
                if (isset($filter['priceRange'])) {
                    $priceRange = explode(',', $filter['priceRange']);
                    if (isset($priceRange)){
                        $q->whereBetween('leaseprijs_per_maand', [$priceRange[0], $priceRange[1]]);
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['brands'])) {
                    $count = 0;
                    foreach ($filter['brands'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('merk', '=', $i);
                        } else {
                            $sub->orWhere('merk', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['types'])) {
                    $count = 0;
                    foreach ($filter['types'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('type', '=', $i);
                        } else {
                            $sub->orWhere('type', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['amountOfDoors'])) {
                    $count = 0;
                    foreach ($filter['amountOfDoors'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('aantal_deuren', '=', $i);
                        } else {
                            $sub->orWhere('aantal_deuren', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['fuel'])) {
                    $count = 0;
                    foreach ($filter['fuel'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('brandstof', '=', $i);
                        } else {
                            $sub->orWhere('brandstof', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['auto_segment'])) {
                    $count = 0;
                    foreach ($filter['auto_segment'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('auto_segment', '=', $i);
                        } else {
                            $sub->orWhere('auto_segment', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['carrosserie'])) {
                    $count = 0;
                    foreach ($filter['carrosserie'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('carrosserie', '=', $i);
                        } else {
                            $sub->orWhere('carrosserie', '=', $i);
                        }
                    }
                }
            })
            ->where(function($sub) use ($filter){
                if (isset($filter['color'])) {
                    $count = 0;
                    foreach ($filter['color'] as $i) {
                        $count++;
                        if ($count == 1) {
                            $sub->where('kleur', 'LIKE', '%'.$i.'%');
                        } else {
                            $sub->orWhere('kleur', 'LIKE', '%'.$i.'%');
                        }
                    }
                }
            })
            ->get();

        $baseOffers = $this->offer;

        return view('site.lease-offers', compact('offers', 'baseOffers', 'filter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title, $id)
    {
        $offer = $this->offer->findOrFail($id);

        //default seo
        $this->seo()
            ->setCanonical(url()->current())
            ->setTitle($offer->title)
            ->setDescription($offer->meta_description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->addProperty('type', 'site')
            ->addImage($offer->thumbnail())
            ->setTitle($offer->meta_title)
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter()
            ->setTitle($offer->meta_title);

        return view('site.lease-offer', compact('offer'));
    }

}
