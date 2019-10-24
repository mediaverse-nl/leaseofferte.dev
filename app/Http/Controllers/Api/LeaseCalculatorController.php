<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaseCalculatorController extends Controller
{
    public function show()
    {

        return response()
            ->json('ok', 200);
    }
}
