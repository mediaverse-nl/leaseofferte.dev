<?php

namespace App\Http\Controllers\Site;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    protected $stock, $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->stock = [
            [
                'id' => '1',
                'title' => 'alpha romeo',
                'description' => 'alpha romeo',
            ],
            [
                'id' => '2',
                'title' => 'alpha romeo',
                'description' => 'alpha romeo',
            ],
        ];
    }

    public function index()
    {
        $stock = (object)$this->stock;

        return view('site.stock-solutions', compact('stock'));
    }

    public function show()
    {
        return view();
    }
}
