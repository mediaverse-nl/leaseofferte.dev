<?php

namespace App\Http\Controllers\Site;

use App\LeaseOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaseOfferController extends Controller
{
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
        $offers = $this->offer->get();

        return view('site.lease-offers', compact('offers'));
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


        return view('site.lease-offer', compact('offer'));
    }

}
