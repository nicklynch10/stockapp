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
use Phpml\Math\Statistic\Correlation;
use Phpml\Math\Statistic\StandardDeviation;
use Carbon\Carbon;

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
        $this->token = env('IEX_CLOUD_KEY', null);
        $this->endpoint = env('IEX_CLOUD_ENDPOINT', null);
    }



    public function getIEXData()
    {


        // only requests data from IEX if it has not been requested yet today
        if ($this->date_updated == Carbon::today()->format("Y-m-d")) {
            return "no request needed";
        }

        //sends a get request to IEX for company info
        $url = ($this->endpoint . 'stable/stock/'.$this->ticker.'/stats?token=' . $this->token);
        //dd($url);
        $data = Http::get($url);

        // extracts and saves data
        $stats = $data->json();
        if (!isset($stats)) {
            return "company info query failed";
        }

        $this->beta = $stats['beta'];
        $this->div_yield = $stats['dividendYield'];
        $this->company_name = $stats['companyName'];
        $this->peRatio = $stats['peRatio'];
        $this->year1ChangePercent = $stats['year1ChangePercent'];
        $this->marketcap = $stats['marketcap']/1000;
        $this->info_data = json_encode($data->json());


        //sends a get request to IEX for historical data
        $url = $this->endpoint . 'stable/stock/'.$this->ticker.'/chart/'.$this->range.'?token=' . $this->token;
        $data = Http::get($url);

        $stats = $data->json();
        if (!isset($stats)) {
            return "historical query failed";
        }

        $historical_data = collect($data->json());


        //stores all of the data in a json text string.
        $this->historical_data = json_encode($historical_data);
        $this->change_data = json_encode($historical_data->pluck("changePercent")->map(function ($item) {
            return $item*100; // multiplies by 100
        })->toArray());
        $this->price_data = json_encode($historical_data->pluck("close")->toArray());
        $this->date_data = json_encode($historical_data->pluck("date")->toArray());
        $this->volume_data = json_encode($historical_data->pluck("volume")->toArray());
        // use the pluck function to extract a single datapoint

        // calculates the Standard Deviation
        $this->date_updated = Carbon::today()->format("Y-m-d");
        //$this->std = $this->Standard_Deviation($this->getChangeData());
        $this->std = StandardDeviation::population($this->getChangeData()->toArray());
        $this->calced_beta = $this->calcBeta();

        // saves for future use
        $this->save();
    }


    public function getChangeData()
    {
        return collect(json_decode($this->change_data));
    }

    public function getDateData()
    {
        return collect(json_decode($this->date_data));
    }

    public function getVolumeData()
    {
        return collect(json_decode($this->volume_data));
    }

    public function getPriceData()
    {
        return collect(json_decode($this->price_data));
    }

    public function calcBeta()
    {
        //calculates beta using the S&P 500

        $ticker = "SPY"; // S&P 500
        if ($this->ticker == $ticker) {
            return 1; // prevents recursion
        }
        //initialize a SecInfo model
        $SI1 = getTicker($ticker);

        $p = Correlation::pearson($SI1->getChangeData()->toArray(), $this->getChangeData()->toArray());
        $beta = $p*$SI1->std*$this->std;
        //$beta = $this->getCovariance($SI1->getChangeData(), $this->getChangeData());
        return $beta;
    }

    public function compareToTicker($ticker)
    {
        $ticker = $ticker;
        if ($this->ticker == $ticker) {
            return 1; // prevents recursion
        }
        //initialize a SecInfo model
        $SI1 = getTicker($ticker);

        if ($SI1->getDateData()->first() != $this->getDateData()->first()) {
            dd("Dates did not match");
        }

        $p = Correlation::pearson($SI1->getChangeData()->toArray(), $this->getChangeData()->toArray());

        $SC = new SecCompare();
        $SC->SI1()->associate($this);
        $SC->SI2()->associate($SI1);
        $SC->ticker1 = $this->ticker;
        $SC->ticker2 = $SI1->ticker;
        $SC->correlation = $p;
        $SC->range = $this->range;
        $SC->amount = $this->getChangeData()->count();
        $SC->save();

        return $SC;
    }

    public function compareToFactor($factor)
    {
        $this->getIEXData();

        if ($factor->getDateData()->first() != $this->getDateData()->first()) {
            dd("Dates did not match");
        }

        $p = Correlation::pearson($factor->getChangeData()->toArray(), $this->getChangeData()->toArray());


        $SC = new FactorCompare();
        $SC->SI()->associate($this);
        $SC->factor()->associate($factor);
        $SC->ticker = $this->ticker;
        $SC->factor_name = $factor->name;
        $SC->correlation = $p;
        $SC->range = $this->range;
        $SC->amount = $this->getChangeData()->count();
        $SC->save();

        return $SC;
    }



















    /////////////// not used - pre 4.19.22 //////

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
        //$SI1->setInfo();
        } else {
            $SI1 = new SecInfo();
            $SI1->ticker = $ticker;
            $SI1->setInfo();
        }
        return $SI1;
    }


    public function statsUpdate()
    {
        $url = $this->endpoint . 'stable/stock/'.$this->ticker.'/chart/'.$this->range.'?token=' . $this->token;
        $data = Http::get($url);

        $prices = collect($data->json());
        //stores all of the price data in a json text string.
        $this->price_data = json_encode($data->json());
        $this->change_data = json_encode($prices->pluck("changePercent")->toArray());
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
        $this->marketcap = $stats['marketcap']/1000;
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


    public function createFactorDiff($SI)
    {
        $this->setInfo();
        $SI->setInfo();

        $FSI = $this->replicate();
        $FSI->ticker = $this->ticker."_".$SI->ticker;

        $prices1 = collect(json_decode($this->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $prices2 = collect(json_decode($SI->price_data))->pluck("changePercent")->map(function ($item) {
            return $item*100;
        });

        $prices = $prices1->map(function ($price, $key) use ($prices2) {
            return $price - $prices2[$key];
        });

        $FSI->change_data = json_encode($prices);
        return $FSI;
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

        //dd($prices1);

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
        $p = $covar/(($this->std)*($SI->std));
        return $p;
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
        $arr = collect($arr);
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
