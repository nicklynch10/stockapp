<?php

use App\Models\SecInfo;
use App\Models\Factor;

if (!function_exists('getTicker')) {
    function getTicker($ticker)
    {
        //creates an SecInfo from a ticker
        // will not create if exists already

        $SI1 = SecInfo::all()->where("ticker", $ticker)->first();
        if (!$SI1) {
            $SI1 = new SecInfo();
            $SI1->ticker = $ticker;
        }
        $SI1->getIEXData();
        return $SI1;
    }
}


if (!function_exists('getFactor')) {
    function getFactor($ticker1, $ticker2, $operator)
    {
        //creates an Factor from a ticker
        // will not create if exists already

        $f = Factor::all()->where("ticker1", $ticker1)->where("ticker2", $ticker2)->where("operator", $operator)->first();
        if (!$f) {
            $f = new Factor();
            $f->create($ticker1, $ticker2);
        }
        $f->refresh();
        return $f;
    }
}
