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

        $data = [];

        if (!$category->dynamicFieldsExists('email')) {
            $data[] = [
                'field_name' => 'email',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required|email',
                'field_order' => '1',
                'category_id' => $category->id,
            ];
        }

        if (!$category->dynamicFieldsExists('voorletter(s)')) {
            $data[] = [
                'field_name' => 'voorletter(s)',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required',
                'field_order' => '2',
                'category_id' => $category->id,
            ];
        }

        if (!$category->dynamicFieldsExists('voornaam')) {
            $data[] = [
                'field_name' => 'voornaam',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required',
                'field_order' => '3',
                'category_id' => $category->id,
            ];
        }

        if (!$category->dynamicFieldsExists('achternaam')) {
            $data[] = [
                'field_name' => 'achternaam',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required',
                'field_order' => '4',
                'category_id' => $category->id,
            ];
        }

        if (!$category->dynamicFieldsExists('K.v.K. nummer')) {
            $data[] = [
                'field_name' => 'K.v.K. nummer',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required|numeric',
                'field_order' => '5',
                'category_id' => $category->id,
            ];
        }

        if (!$category->dynamicFieldsExists('bedrijfsnaam')) {
            $data[] = [
                'field_name' => 'bedrijfsnaam',
                'field_type' => 'text',
                'form_part' => '3',
                'field_validation' => 'required',
                'field_order' => '6',
                'category_id' => $category->id,
            ];
        }

        if (!empty($data)) {
            $this->dynamicField->insert($data);
        }

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

                $dynamicField = $this->dynamicField->find($i);
                $dynamicField->field_validation = isset($f['rules']) ? implode('|', array_keys($f['rules'])) : '';
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
            $dynamicField->field_validation = isset($request->rules) ? implode('|', array_keys($request->rules)) : '';
            $dynamicField->field_order = 3;
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
