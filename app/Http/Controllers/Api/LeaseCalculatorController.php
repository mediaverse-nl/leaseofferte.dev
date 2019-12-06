<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class LeaseCalculatorController extends Controller
{
    protected $category, $solution;

    public function __construct(Category $category, Solution $solution)
    {
        $this->category = $category;
        $this->solution = $solution;
    }

    public function show()
    {
        $category = $this->category;

        $object = request()->input('object');
        $objectgroep = request()->input('objectgroep');

        $formulierVelden = [];
        $categories = $category;

        if ($objectgroep){
            $solutions = $this->solution
                ->whereHas('category',function (Builder $q) use ($objectgroep){
                    $q->where('id', '=', $objectgroep);
                });
            $formulierVelden = $category
                ->where('id', '=', $objectgroep)
                ->first()
                ->dynamicFields()
                ->get(['field_name', 'field_type', 'field_validation', 'form_part', 'field_order'])
                ->toArray();
        }else{
            $solutions = $this->solution;
        }

        return response()
            ->json([
                'objectgroepen' => $categories->get(['id', 'value'])->toArray(),
                'objecten' => $solutions->get(['id', 'title'])->toArray(),
                'formulierVelden' => $formulierVelden,
            ], 200);
    }
}
