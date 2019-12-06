<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\DynamicField;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category, $dynamicField;

    public function __construct(Category $category, DynamicField $dynamicField)
    {
        $this->category = $category->parents();
        $this->dynamicField = $dynamicField;
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

        $category->value = $request->value;
        $category->interest_rate = (string)implode(',', $request->rate);;
        $category->save();

        if (isset($request->dynamicFields)){
            foreach ($request->dynamicFields as $i => $f){
                $field_validation = '';
                if (isset($f['rules'])){
                    foreach ($f['rules'] as $ri => $rv){
                        $field_validation .= (isset($f[$ri]) ? '':$rv).'|';
                        if (in_array('required', $f['rules'])
                            && $rv == 'nullable|regex:#^(((\+31|0|0031)6){1}[1-9]{1}[0-9]{7})$#i')
                        {
                            $field_validation = str_replace('nullable|', '', $field_validation);
                        }
                    }
                    $field_validation = substr($field_validation, 0, -1);
                }

                $dynamicField = $this->dynamicField->find($i);
                $dynamicField->field_validation = $field_validation;
                $dynamicField->field_name = $f['field_name'];
                $dynamicField->field_type = $f['field_type'];
                $dynamicField->field_order = $f['field_order'];
                $dynamicField->form_part = $f['form_part'];
                $dynamicField->save();

                if (isset($request->dynamicFields[$i]['delete']) ? true : false){
                    $delete = $this->dynamicField->find($i);
                    $delete->delete();
                }
             }
        }

        if (isset($request->field_name)){
            $dynamicField = $this->dynamicField;
            $dynamicField->field_name = $request->field_name;
            $dynamicField->field_type = $request->field_type;
            $dynamicField->form_part = $request->form_part;
            $dynamicField->field_validation = $request->field_validation;
            $dynamicField->field_order = isset($request->dynamicFields) ? count($request->dynamicFields) + 1 : 1;
            $dynamicField->category_id = $category->id;
            $dynamicField->save();
        }

        return redirect()
            ->route('admin.category.edit', $category->id);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category;

        $category->value = $request->value;
        $category->interest_rate = (string)implode(',', $request->rate);;
        $category->save();

        if (isset($request->field_name)){
            $dynamicField = $this->dynamicField;
            $dynamicField->field_name = $request->field_name;
            $dynamicField->field_type = $request->field_type;
            $dynamicField->form_part = $request->form_part;
            $dynamicField->field_validation = $request->field_validation;
            $dynamicField->field_order = isset($request->dynamicFields) ? count($request->dynamicFields) + 1 : 1;
            $dynamicField->category_id = $category->id;
            $dynamicField->save();
        }

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
