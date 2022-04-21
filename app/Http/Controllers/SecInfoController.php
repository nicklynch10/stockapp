<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\StockTicker;
use Illuminate\Support\Facades\Http;
use Phpml\Classification\KNearestNighbors as ML;
//https://php-ml.readthedocs.io/en/latest/machine-learning/regression/least-squares/
use Phpml\Math\Statistic\Correlation;
//https://php-ml.readthedocs.io/en/latest/math/statistic/
use Phpml\Math\Statistic\StandardDeviation;
//https://php-ml.readthedocs.io/en/latest/math/statistic/
use Phpml\Regression\LeastSquares;

class SecInfoController extends Controller
{
    public $portfolio = [
        "TM","GOOG","BABA","TSLA","GM","F","M","NKE","AMZN"
    ];

    public $size_factor = [
        "MGC","VV","VO","VB"
    ];

    public $geo_factor = [
        "SPY","VGK","VPL","VEA","VWO"
    ];

    public $value_factor = [
        "VTV","VUG"
    ];

    public $sector = [
        "VOX","VCR","VDC","VDE","VFH","VHT","VIS","VGT","VAW","VNQ","VPU"
    ];

    public $asset_types = [
        "VT","VNQ","BNDW","VCLT","VWOB"
    ];


    public function view()
    {
        return view('correlations\correlation-check');
    }





    public function launch()
    {
        $stock = getTicker("GM");
        $stock->pullIEXPeers();
        //echo "here";
        dd($stock);
        //dd($comps);
    }



    public function linear_regression($x, $y)
    {
        $n     = count($x);     // number of items in the array
        $x_sum = array_sum($x); // sum of all X values
        $y_sum = array_sum($y); // sum of all Y values

    $xx_sum = 0;
        $xy_sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $xy_sum += ($x[$i]*$y[$i]);
            $xx_sum += ($x[$i]*$x[$i]);
        }

        // Slope
        $slope = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));

        // calculate intercept
        $intercept = ($y_sum - ($slope * $x_sum)) / $n;

        //rSquared = POW(($this->coordinateCount * $xy_sum - $x_sum * $y_sum) / sqrt(($this->coordinateCount * $xx_sum - $x_sum * $x_sum) * ($this->coordinateCount * $yy_sum - $y_sum * $y_sum)),2);

        return array(
        'slope'     => $slope,
        'intercept' => $intercept
    );
    }


    public function regression()
    {
        $samples = [[60], [61], [62], [63], [65]];
        $targets = [3.1, 3.6, 3.8, 4, 4.1];

        $regression = new LeastSquares();
        $regression->train($samples, $targets);
        return $regression->predict([64]);
    }
}
