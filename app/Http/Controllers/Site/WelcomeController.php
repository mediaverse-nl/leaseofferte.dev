<?php

namespace App\Http\Controllers\Site;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function __invoke()
    {
        $category = $this->category;

        $formObj = !empty(session('formFields')) ? (object)decrypt(session('formFields')) : (object)[];
        if (isset($formObj->objectgroep)){
            $category_id = $formObj->objectgroep;
            $tableFields = $category->where('id', '=', $category_id)->first();
        }else{
            $tableFields = $category->first();
        }

//        if ($tableFields->dynamicFields > 0){
            $tableFieldsOne = $tableFields->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'ASC')->get();
            $tableFieldsTwo = $tableFields->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get();
//        }

        return view('site.welcome', compact('tableFieldsOne', 'tableFieldsTwo'));
    }
}
