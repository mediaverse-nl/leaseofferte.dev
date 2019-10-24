<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Solution;
use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaseSolutionController extends Controller
{
    use SEOTools, SeoManager;

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

        //default seo
        $this->seo()
            ->setTitle($solution->meta_title)
            ->setDescription($solution->meta_description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setTitle($solution->meta_title)
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter()
            ->setTitle($solution->meta_title);

//        dd($solution, $id, $title);
        if ($solution->urlTitle !== $title){
            return redirect()->route('site.solution.show', [$solution->urlTitle, $solution->id]);
        }

        return view('site.lease-solution', compact('solution'));
    }

}
