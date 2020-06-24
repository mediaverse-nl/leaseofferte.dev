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
        $solutions = $this->solution->with('category')->orderBy('title')->get();
        $categories = $this->category->orderBy('value')->get();

        return view('site.lease-solutions', compact('solutions', 'categories'));
    }

    public function show($title, $id)
    {
        $solution = $this->solution->with('category')->findOrFail($id);

        //default seo
        $this->seo()
            ->setCanonical(url()->current())
            ->setTitle($solution->meta_title)
            ->setDescription($solution->meta_description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->addProperty('type', 'site')
            ->addImage(str_replace('https://mediaverse-dev.nl', 'https://www.leaseofferte.com/', $solution->thumbnail()))
            ->setTitle($solution->meta_title)
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter()
            ->setTitle($solution->meta_title);

        if ($solution->urlTitle !== $title){
            return redirect()->route('site.solution.show', [$solution->urlTitle, $solution->id]);
        }

        return view('site.lease-solution', compact('solution'));
    }

}
