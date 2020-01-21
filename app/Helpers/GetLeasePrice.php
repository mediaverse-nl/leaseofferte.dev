<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getLeasePrice')) {

    /**
     * description
     *
     * @param richtext  / richtext  / text
     * @return
     */

    function getLeasePrice($aanschaf, $looptijd)
    {
        $financeRate = 0.0599;
        $total = ($aanschaf);

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

        $test1 = 0;
        for($ti = 0; $ti < count($arr); $ti++) {
            $test1 += $arr[$ti] * $financeRate;
        }
        $avg = $test1 / count($arr) / 12;

        $total = ($total / $looptijd) + ($avg) + (0 * $financeRate / 12);

        return number_format($total, 0);
    }
}
