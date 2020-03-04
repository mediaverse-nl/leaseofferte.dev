<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StaticSolutionStoreRequest;
use App\Http\Requests\Admin\StaticSolutionUpdateRequest;
use App\LeaseOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaseOfferController extends Controller
{
    protected $solution;

    public function __construct(LeaseOffer $solution)
    {
        $this->solution = $solution;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solutions = $this->solution
            ->get();

        return view('admin.static-solution.index')
            ->with('solutions', $solutions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solution = $this->solution;

        return view('admin.static-solution.create')
            ->with('solution', $solution);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaticSolutionUpdateRequest $request)
    {
        $colors = implode(',', $request->kleur);

        $solution = $this->solution;

        $solution->images = $request->images;
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->uitvoering = $request->uitvoering;
        $solution->merk = $request->merk;
        $solution->type = $request->type;
        $solution->aantal_deuren = $request->number_of_doors;
        $solution->auto_segment = $request->auto_segment;
        $solution->carrosserie = $request->carrosserie;
        $solution->brandstof = $request->fuel;
        $solution->kleur = $colors;
        $solution->inbegrepen = $request->inbegrepen;
        $solution->catalogusprijs = $request->catalogusprijs;
        $solution->bijtelling = $request->bijtelling;
        $solution->meta_title = $request->meta_title;
        $solution->meta_description = $request->meta_description;

        $solution->save();

        $properties = [];
        foreach (collect($request->lease_conditions)->filter() as $property){
            $properties[] = [
                'lease_offers_id' => $solution->id,
                'leaseprijs_per_maand' => $property['leaseprijs_per_maand'],
                'km_per_jaar' => $property['km_per_jaar'],
                'looptijd' => $property['looptijd'],
            ];
        }
        $solution->operationalLeasePrices()->insert($properties);

        return redirect()
            ->route('admin.static-solution.edit', $solution->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solution = $this->solution
            ->findOrFail($id);

        return view('admin.static-solution.edit')
            ->with('solution', $solution);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaticSolutionUpdateRequest $request, $id)
    {
        $colors = implode(',', $request->kleur);

        $solution = $this->solution->findOrFail($id);

        $solution->images = $request->images;
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->uitvoering = $request->uitvoering;
        $solution->merk = $request->merk;
        $solution->type = $request->type;
        $solution->aantal_deuren = $request->number_of_doors;
        $solution->auto_segment = $request->auto_segment;
        $solution->carrosserie = $request->carrosserie;
        $solution->brandstof = $request->fuel;
        $solution->kleur = $colors;
        $solution->inbegrepen = $request->inbegrepen;
        $solution->catalogusprijs = $request->catalogusprijs;
        $solution->bijtelling = $request->bijtelling;
        $solution->meta_title = $request->meta_title;
        $solution->meta_description = $request->meta_description;

        $solution->save();

        $solution
            ->operationalLeasePrices()
            ->where('lease_offers_id', '=', $solution->id)
            ->delete();

        $properties = [];
        foreach (collect($request->lease_conditions)->filter() as $property){
            $properties[] = [
                'lease_offers_id' => $solution->id,
                'leaseprijs_per_maand' => $property['leaseprijs_per_maand'],
                'km_per_jaar' => $property['km_per_jaar'],
                'looptijd' => $property['looptijd'],
            ];
        }
        $solution->operationalLeasePrices()->insert($properties);

        return redirect()
            ->route('admin.static-solution.edit', $solution->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solution = $this->solution->findOrFail($id);

        $solution->delete();

        return redirect()
            ->route('admin.static-solution.index');
    }
}
