<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\SecCompare;
use App\Models\StockTicker;
use Illuminate\Support\Facades\Http;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;

class SecInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticker'
    ];

    public $token;
    public $endpoint;
    public $range = "1y";

    public function __construct()
    {
        $this->token = env('LIVE_IEX_CLOUD_KEY', null);
        $this->endpoint = env('LIVE_IEX_CLOUD_ENDPOINT', null);
    }

    public function setInfo()
    {
        $this->statsUpdate();
        $this->infoUpdate();
        $this->save();

        //calc normal beta for all
        $SPY = $this->findByTicker("SPY");
        $beta = $this->createCorrelation($SPY);
        $this->calced_beta = $beta->correlation;
        $this->save();
    }


    public function findByTicker($ticker)
    {
        //$SI1 = SecInfo::firstOrNew(['ticker'=>$ticker]);
        if (SecInfo::all()->where('ticker', $ticker)->first()) {
            $SI1 = SecInfo::all()->where('ticker', $ticker)->first();
        } else {
            $SI1 = new SecInfo();
            $SI1->ticker = $ticker;
            $SI1->setInfo();
        }
        return $SI1;
    }


    public function statsUpdate()
    {
        $data = Http::get($this->endpoint . 'stable/stock/'.$this->ticker.'/chart/'.$this->range.'?token=' . $this->token);
        //stores all of the price data in a json text string.
        $this->price_data = json_encode($data->json());
        $prices = collect($data->json());

        // use the pluck function to extract a single datapoint
        $dates = $prices->pluck("date");
        $dollar_prices = $prices->pluck("close");

        // price data used for calculations
        $prices = $prices->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });
        // note it is taking % change not $ price.

        // calculates the Standard Deviation
        $std = $this->Standard_Deviation($prices);
        $this->std = $std;
    }

    public function infoUpdate()
    {
        // pulling beta and other stats //
        // /stock/{symbol}/stats/{stat?}
        // https://iexcloud.io/docs/api/#stats-basic
        $data = Http::get($this->endpoint . 'stable/stock/'.$this->ticker.'/stats?token=' . $this->token);
        $this->stats_data = json_encode($data->json());


        $stats = $data->json();
        if (!isset($stats)) {
            return "query failed";
        }
        $this->beta = $stats['beta'];
        $this->div_yield = $stats['dividendYield'];
        $this->company_name = $stats['companyName'];
        $this->peRatio = $stats['peRatio'];
        $this->year1ChangePercent = $stats['year1ChangePercent'];
        $this->marketcap = $stats['marketcap'];
    }


    public function createCorrelation($SI)
    {
        if ($SI->ticker == $this->ticker) {
            $cor = 1;
        } else {
            $cor = $this->calcCorrelation($SI);
        }

        $SC = new SecCompare();
        $SC->SI1()->associate($this);
        $SC->SI2()->associate($SI);
        $SC->ticker1 = $this->ticker;
        $SC->ticker2 = $SI->ticker;
        $SC->correlation = $cor;
        $SC->range = $this->range;
        $SC->amount = collect(json_decode($this->price_data))->pluck("changePercent")->count();

        $SC->save();
        return $SC;
    }

    public function calcCorrelation($SI)
    {
        //$SI->setInfo();
        $prices1 = collect(json_decode($this->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $prices2 = collect(json_decode($SI->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $dates1 = collect(json_decode($this->price_data))->pluck("date");
        $dates2 = collect(json_decode($this->price_data))->pluck("date");
        $data = collect([$prices1,$dates1,$prices2,$dates2]);
        if ($dates1->first() != $dates2->first() || $dates1->last() != $dates2->last()) {
            dd("dates do not match?", $dates1, $dates2);
        }
        $covar = $this->getCovariance($prices1->toArray(), $prices2->toArray());


        $this->std = $this->getCovariance($prices1->toArray(), $prices1->toArray());
        $this->save();


        $SI->std = $SI->getCovariance($prices2->toArray(), $prices2->toArray());
        $SI->save();

        $var = pow(($this->std), 2);
        return $covar/($this->std)*($SI->std);
    }

    public function calcR2($SI)
    {
        //$SI->setInfo();
        $prices1 = collect(json_decode($this->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $prices2 = collect(json_decode($SI->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $dates1 = collect(json_decode($this->price_data))->pluck("date");
        $dates2 = collect(json_decode($this->price_data))->pluck("date");
        $data = collect([$prices1,$dates1,$prices2,$dates2]);
        if ($dates1->first() != $dates2->first() || $dates1->last() != $dates2->last()) {
            dd("dates do not match?", $dates1, $dates2);
        }

        $regression = new LeastSquares();
        $regression->train($prices1, $prices2);
        dd($regression);
        //return $regression->getCoefficients()[0];
    }




    /////////////// stats functions /////////
    public function getCovariance($valuesA, $valuesB)
    {
        // sizing both arrays the same, if different sizes
        $no_keys = min(count($valuesA), count($valuesB));
        $valuesA = array_slice($valuesA, 0, $no_keys);
        $valuesB = array_slice($valuesB, 0, $no_keys);

        // if size of arrays is too small
        if ($no_keys<2) {
            return 0.0000000000001;
        }

        // Use library function if available
        if (function_exists('stats_covariance')) {
            return stats_covariance($valuesA, $valuesB);
        }

        $meanA=(float)array_sum($valuesA)/$no_keys;
        $meanB=(float)array_sum($valuesB)/$no_keys;
        $add=0.0;

        for ($pos=0; $pos < $no_keys; $pos++) {
            $valueA=$valuesA[ $pos ];
            if (!is_numeric($valueA)) {
                trigger_error('Not numerical value in array A at position '. $pos .', value='. $valueA, E_USER_WARNING);
                return false;
            }

            $valueB=$valuesB[ $pos ];
            if (!is_numeric($valueB)) {
                trigger_error('Not numerical value in array B at position '. $pos .', value='. $valueB, E_USER_WARNING);
                return false;
            }

            $difA=$valueA - $meanA;
            $difB=$valueB - $meanB;
            $add += (float)($difA * $difB);
        }

        return (float)$add/($no_keys-1);
    }


    public function Standard_Deviation($arr)
    {
        //return (float)sqrt($this->getCovariance($arr->toArray(), $arr->toArray()));

        $variance = 0.0;
        $num_of_elements = $arr->count();
        if ($num_of_elements == 0) {
            $num_of_elements = 2;
        }

        // calculating mean
        $average = (float)$arr->sum()/$num_of_elements;

        foreach ($arr as $i) {
            // sum of squares of differences between
            // all numbers and means.
            $variance += pow((float)($i - $average), 2);
        }

        return (float)sqrt($variance/($num_of_elements-1));
    }
}
