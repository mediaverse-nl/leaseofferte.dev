<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Page;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
//    use SoftDeletes;

    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->page
            ->withTrashed()
            ->get();

        return view('admin.pages.index')
            ->with('pages', $pages);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function edit($id)
    {
        $page = $this->page
            ->withTrashed()
            ->findOrFail($id);

        return view('admin.pages.edit')
            ->with('page', $page);
    }

    public function update(PageUpdateRequest $request, $id)
    {
        $page = $this->page
            ->withTrashed()
            ->findOrFail($id);

        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->body = $request->body;
        $page->meta_description = $request->meta_description;
        $page->meta_title = $request->meta_title;

        $page->save();

        return redirect()
            ->route('admin.pages.index');
    }

    public function store(PageStoreRequest $request)
    {
        $page = $this->page;

        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->body = $request->body;
        $page->meta_description = $request->meta_description;
        $page->meta_title = $request->meta_title;

        $page->save();

        return redirect()
            ->route('admin.pages.edit', $page->id);
    }

    public function destroy(Request $request, $id)
    {
        $page = $this->page
            ->withTrashed()
            ->findOrFail($id);

        if ($page->trashed()){
            $page->restore();
        }else{
            $page->delete();
        }

        return redirect()
            ->route('admin.pages.index');
    }
}
