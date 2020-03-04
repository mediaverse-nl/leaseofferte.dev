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

    public function get(Request $request, $objectId)
    {
        $object = $this->objects->findOrFail($objectId);

        $leasePrice = getLeasePrice($objectId, $request->aanschaf, $request->looptijd, $request->slottermijn, $request->aanbetaling);

        return response()
            ->json([
                'rate' => $object->getFinancialRate($request->aanschaf - $request->aanbetaling),
                'leasePrice' => $leasePrice,
            ], 200);
    }
}
