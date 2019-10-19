<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaseSolutionController extends Controller
{
    protected $solution, $category;

    public function __construct(Solution $solution, Category $category)
    {
        $this->solution = $solution;
        $this->category = $category;
    }

    public function index()
    {
        $solutions = $this->solution->get();
        $categories = $this->category->get();

        return view('site.lease-solutions', compact('solutions', 'categories'));
    }

    public function show($title, $id)
    {

        $solution = $this->solution->findOrFail($id);

//        dd($solution, $id, $title);
        if ($solution->urlTitle !== $title){
            return redirect()->route('site.solution.show', [$solution->urlTitle, $solution->id]);
        }

        return view('site.lease-solution', compact('solution'));
    }

}
