<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SolutionUpdateRequest;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolutionController extends Controller
{
    protected $solution;

    public function __construct(Solution $solution)
    {
        $this->solution = $solution;
    }

    public function index()
    {
        $solutions = $this->solution
            ->get();

        return view('admin.solution.index')
            ->with('solutions', $solutions);
    }

    public function edit($id)
    {
        $solution = $this->solution
            ->findOrFail($id);

        return view('admin.solution.edit')
            ->with('solution', $solution);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SolutionUpdateRequest $request, $id)
    {
        $solution = $this->solution
            ->findOrFail($id);

        $solution->image = $request->image;
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->meta_title = $request->meta_title;
        $solution->meta_description = $request->meta_description;

        $solution->save();

        return redirect()
            ->route('admin.solution.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
