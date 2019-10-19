<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category->parents();
    }

    public function index()
    {
        $category = $this->category
            ->withTrashed()
            ->get();

        return view('admin.category.index')
            ->with('categories', $category);
    }

    public function edit($id)
    {
        $category = $this->category
            ->withTrashed()
            ->findOrFail($id);

        return view('admin.category.edit')
           ->with('category', $category);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = $this->category
            ->withTrashed()
            ->findOrFail($id);

//        $category->image = $request->image;
        $category->value = $request->value;

        $category->save();

        return redirect()
            ->route('admin.category.index');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category;

        $category->value = $request->value;
//        $category->image = $request->image;
        $category->order = 0;

        $category->save();

        return redirect()
            ->route('admin.category.edit', $category->id);
    }

    public function destroy(Request $request, $id)
    {
        $category = $this->category
            ->withTrashed()
            ->findOrFail($id);

        if ($category->trashed()){
            $category->restore();
        }else{
            $category->delete();
        }

        return redirect()
            ->route('admin.category.index');
    }

}
