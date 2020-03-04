<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;

use App\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    protected $portfolio, $category;

    public function __construct(Portfolio $portfolio, Category $category)
    {
        $this->portfolio = $portfolio;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = $this->portfolio
            ->get();

        return view('admin.portfolio.index')
            ->with('portfolios', $portfolio);
    }

    public function create()
    {
        $categories = $this->category->get();

        return view('admin.portfolio.create')
            ->with('categories', $categories);
    }

    public function edit($id)
    {
        $portfolio = $this->portfolio
            ->findOrFail($id);

        $categories = $this->category->get();

        return view('admin.portfolio.edit')
            ->with('portfolio', $portfolio)
            ->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        $portfolio = $this->portfolio
            ->findOrFail($id);

        $portfolio->title = $request->title;
        $portfolio->image = $request->image;
        $portfolio->location = $request->location;
        $portfolio->branch = $request->branch;
        $portfolio->save();

        return redirect()
            ->route('admin.portfolio.index');
    }

    public function store(Request $request)
    {
        $portfolio = $this->portfolio;

        $portfolio->title = $request->title;
        $portfolio->image = $request->image;
        $portfolio->location = $request->location;
        $portfolio->branch = $request->branch;
        $portfolio->save();

        return redirect()
            ->route('admin.portfolio.edit', $portfolio->id);
    }

    public function destroy(Request $request, $id)
    {
        $portfolio = $this->portfolio
             ->findOrFail($id);

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolio.index');
    }
}
