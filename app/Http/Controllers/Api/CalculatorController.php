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

        $aanschaf = $request->aanschaf;
        $looptijd = $request->looptijd;
        $slottermijn = $request->slottermijn;
        $aanbetaling = $request->aanbetaling;

        if (isset($aanschaf) && !is_numeric($aanschaf)){
            $aanschaf = 0;
        }
        if (isset($looptijd) && !is_numeric($looptijd)){
            $looptijd = 0;
        }
        if (isset($slottermijn) && !is_numeric($slottermijn)){
            $slottermijn = 0;
        }
        if (isset($aanbetaling) && !is_numeric($aanbetaling)){
            $aanbetaling = 0;
        }

        $leasePrice = getLeasePrice($objectId, $aanschaf, $looptijd, $slottermijn, $aanbetaling);

        return response()
            ->json([
                'rate' => $object->getFinancialRate($aanschaf - $aanbetaling),
                'leasePrice' => $leasePrice,
            ], 200);
    }
}
