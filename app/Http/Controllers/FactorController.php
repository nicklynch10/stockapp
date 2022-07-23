<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\SecCompare;
use App\Models\StockTicker;
use App\Models\Factor;
use Illuminate\Support\Facades\Http;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;
use Phpml\Math\Statistic\Correlation;

class FactorController extends Controller
{
    public function test()
    {
        $f = getFactor("VUG", "VTV", "-");
        $f->name = "Value Factor";
        $f->save();
        dd($f);

        $SI = getTicker("GOOG");
        //dd($SI->getChangeData()->avg());
        $FC = $SI->compareToFactor($f);
        dd($FC);
    }

    public function factors()
    {
        return view('correlations.factors');
    }




    public function test2()
    {
        $ticker = "VOO";
        //initialize a SecInfo model
        $SI1 = SecInfo::all()->where("ticker", $ticker)->first();
        if (!$SI1) {
            $SI1 = new SecInfo();
            $SI1->ticker = $ticker;
        }
        $SI1->getIEXData();

        $SC = $SI1->compareTo("SPY");
        dd($SC);
    }


    public function factor_compare()
    {
        $ticker1 = "GM";
        $ticker2 = "TM";
        $stock1 = getTicker($ticker1);
        $stock2 = getTicker($ticker2);

        $factors = Factor::all();
        $n = 0;
        $d = 0;

        foreach ($factors as $f) {
            $FC1 = $stock1->compareToFactor($f);
            $FC2 = $stock2->compareToFactor($f);
            if ($FC1->correlation && $FC2->correlation) {
                $d = $d + pow($FC1->correlation - $FC2->correlation, 2);
                $n = $n + 1;
            }
            if ($n == 0) {
                return 0;
            }
            $MSE = $d/$n;
            return $MSE;
        }
    }
}
