<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getLeasePrice')) {

    /**
     * description
     *
     * @param richtext  / richtext  / text
     * @return
     */

    function getLeasePrice($objectId, $aanschaf, $looptijd, $slottermijn, $aanbetaling)
    {
        $total = ($aanschaf - $aanbetaling - $slottermijn);

        $financeRate = \App\Solution::find($objectId)->getFinancialRate($total);

        $newTotal = null;
        $arr = [];

        for ($i = 0; $i < $looptijd; $i++) {
            if($i == 0){
                $newTotal = $total;
            }else{
                $newTotal = $newTotal - $total / $looptijd;
            }
            $arr[] = $newTotal;
        }

        $countUp = number_format(0, 4);
        for($ti = 0; $ti < count($arr); $ti++) {
            $countUp += $arr[$ti] * $financeRate + 0;
        }

        $avg = $countUp / count($arr) / 12;

        $total = ($total / $looptijd) + ($avg) + ($slottermijn * $financeRate / 12);

        if ( $total < 0 ) {
            $total = 0;
        };

        return number_format($total, 2, ',','.');
    }
}
