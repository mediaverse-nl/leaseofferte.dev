<?php

namespace App\Http\Controllers\Api;

use App\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    protected $objects;

    public function __construct(Solution $solution)
    {
        $this->objects = $solution;
    }

    public function get($object)
    {
        $object = $this->objects->findOrFail($object);

        $category = $object->category;

        return response()
            ->json([
                'rates' => [
                    [
                        'from' => '0',
                        'to' => '24999',
                        'rate' => !empty(explode(",", $category->interest_rate)[0]) ? explode(",", $category->interest_rate)[0] : null,
                    ],
                    [
                        'from' => '25000',
                        'to' => '49999',
                        'rate' => !empty(explode(",", $category->interest_rate)[1]) ? explode(",", $category->interest_rate)[1] : null,
                    ],
                    [
                        'from' => '50000',
                        'to' => '74999',
                        'rate' => !empty(explode(",", $category->interest_rate)[2]) ? explode(",", $category->interest_rate)[2] : null,
                    ],
                    [
                        'from' => '75000',
                        'to' => '100000',
                        'rate' => !empty(explode(",", $category->interest_rate)[2]) ? explode(",", $category->interest_rate)[2] : null,
                    ],
                ],
            ], 200);
    }
}
