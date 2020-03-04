<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\NewsStoreRequest;
use App\Http\Requests\Admin\NewsUpdateRequest;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->news
            ->get();

        return view('admin.news.index')
            ->with('news', $news);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function edit($id)
    {
        $news = $this->news
            ->findOrFail($id);

        return view('admin.news.edit')
            ->with('news', $news);
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        $news = $this->news
            ->findOrFail($id);

        $news->title = $request->title;
        $news->description = $request->description;
        $news->meta_description = '';
        $news->meta_title = '';
        $news->online = 1;
        $news->banner_image = '';
        $news->image = $request->image;

        $news->save();

        return redirect()
            ->route('admin.news.index');
    }

    public function store(NewsStoreRequest $request)
    {
        $news = $this->news;

        $news->title = $request->title;
        $news->description = $request->description;
        $news->meta_description = '';
        $news->meta_title = '';
        $news->online = 1;
        $news->banner_image = '';
        $news->image = $request->image;

        $news->save();

        return redirect()
            ->route('admin.news.edit', $news->id);
    }

    public function destroy(Request $request, $id)
    {
        $news = $this->news
            ->findOrFail($id);

        $news->delete();

        return redirect()
            ->route('admin.news.index');
    }
}
