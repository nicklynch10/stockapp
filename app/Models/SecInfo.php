<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\SecCompare;
use App\Models\StockTicker;
use App\Models\Factor;
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
            // echo "<br>found ".$this->ticker;
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

        //dd($this->ticker);

        $this->beta = $stats['beta'];
        $this->div_yield = $stats['dividendYield'];
        $this->company_name = $stats['companyName'];
        $this->peRatio = $stats['peRatio'];
        $this->year1ChangePercent = $stats['year1ChangePercent'];
        $this->marketcap = $stats['marketcap']/1000;
        $this->info_data = json_encode($data->json());


        //sends a get request to IEX for historical data
        //echo "<br>pulling ".$this->ticker;
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
        if ($this->getChangeData()->count()>0) {
            $this->std = StandardDeviation::population($this->getChangeData()->toArray());
        } else {
            $this->std = 0;
        }
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

    public function getPeerData()
    {
        return collect(json_decode($this->peer_data));
    }

    public function getIEXPeerData()
    {
        return collect(json_decode($this->IEXpeer_data));
    }

    public function calcBeta()
    {
        //calculates beta using the S&P 500
            $ticker = "SPY";// S&P 500
        if ($this->ticker == $ticker) {
            return 1;
        }
        //initialize a SecInfo model
        $SC = $this->compareToTicker($ticker);
        $SI1 = $SC->SI2;
        $p = $SC->correlation;
        $beta = $p*$SI1->std*$this->std;
        //$beta = $this->getCovariance($SI1->getChangeData(), $this->getChangeData());
        return $beta;
    }

    public function compareToTicker($ticker)
    {
        $debug = false;
        //checks if the comparison has already been made within [30] days
        $SC_old = SecCompare::all()->where('ticker2', $this->ticker)->where('ticker1', $ticker)->first();
        //dd($ticker);
        if ($debug) {
            echo "<br>checking if correlation already exists between ".$this->ticker." and ".$ticker." at ".now();
        }
        if ($SC_old && $SC_old->updated_at > now()->addDays(-30) && $SC_old->correlation != 0) {
            if ($debug) {
                echo "<br>Found p. using p from ".$this->ticker." and ".$ticker." at ".now();
            }
            $p = $SC_old->correlation;
            $SI1 = $SC_old->SI1;
        } elseif ($ticker == $this->ticker) {
            $p = 1;
            $SI1 = $this;
        } else {
            //initialize a SecInfo model

            $SI1 = getTicker($ticker);
            if ($SI1->getDateData()->first() != $this->getDateData()->first()) {
                //dd("Sec dates did not match");
                $p = 0;
            } elseif ($SI1->getChangeData()->count() != $this->getChangeData()->count()) {
                $p = 0;
            } else {
                if ($debug) {
                    echo "<br>no p found. Creating new p for ".$this->ticker." and ".$SI1->ticker." at ".now();
                }
                $p = Correlation::pearson($SI1->getChangeData()->toArray(), $this->getChangeData()->toArray());
            }
        }

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
        $factor = Factor::find($factor["id"]);

        //checks if the comparison has already been made within [30] days
        $SC_old = FactorCompare::all()->where('ticker', $this->ticker)->where('factor_id', $factor->id)->first();
        if ($SC_old && $SC_old->updated_at > now()->addDays(-30)) {
            return $SC_old;
        }



        $this->getIEXData();
        //dd($factor);

        //dd($factor, $factor->date_data);
        if (!isset($factor->date_data)|| !isset($this->date_data)) {
            dd("no dates on factor compare", $factor, $this);
        }

        if ($factor->getDateData()->first() != $this->getDateData()->first()) {
            dd("Factor dates did not match", $factor, $this, $factor->getDateData()->first(), $this->getDateData()->first());
        } elseif ($factor->getChangeData()->count() != $this->getChangeData()->count()) {
            dd("size did not match", $factor, $this, $factor->getDateData()->first(), $this->getDateData()->first());
        }

        $p = Correlation::pearson($factor->getChangeData()->toArray(), $this->getChangeData()->toArray());

        $multiplier = 1/3; // adjusts so it is closer to bounds.
        $cor = $p;
        if ($p>0) {
            $cor = $cor**($multiplier);
        } else {
            $cor = -1*((-1*$cor)**($multiplier));
        }

        $SC = new FactorCompare();
        $SC->SI()->associate($this);
        $SC->factor()->associate($factor);
        $SC->ticker = $this->ticker;
        $SC->factor_name = $factor->name;
        $SC->correlation = $cor;
        $SC->range = $this->range;
        $SC->amount = $this->getChangeData()->count();
        $SC->save();

        return $SC;
    }


    public function pullIEXPeers()
    {
        if (!$this->IEXpeer_data) {

            //sends a get request to IEX for historical data
            $url = $this->endpoint . 'stable/stock/'.$this->ticker.'/peers?token=' . $this->token;
            $data = Http::get($url);
            $peers = $data->json();
            if (!isset($peers)) {
                return "peers query failed";
            }

            $peers = collect($data->json());


            $this->IEXpeer_data = json_encode($peers);
            $this->peer_data = json_encode($peers);
        }

        //$new = $this->getPeerData();
        // foreach ($this->getIEXPeerData() as $p) {
        //     if (!$new->contains($p)) {
        //         $new->push($p);
        //     }
        // }

        // cleans the peer data for valid peers only
        $new = $this->getPeerData();  // starts with existing peer data and adds new ones
        $new2 = collect([]);
        $SCs = collect([]);
        foreach ($new as $p) {
            $SC = $this->compareToTicker($p);
            if (isset($SC->correlation) && $SC->correlation != 0 && !$new2->contains($p) && $SC->ticker1 != $SC->ticker2) {
                $new2->push($p);
                $SCs->push($SC);
            }
        }

        // sorts by correlation
        $new3 = collect([]);
        foreach ($SCs->sortByDesc("correlation") as $p) {
            $new3->push($p->ticker2);
        }



        $this->peer_data = json_encode($new3->toArray());
        $this->save();
        return $this->IEXpeer_data;
    }


    public function addRelatedPeers()
    {
        $this->pullIEXPeers();
        $new = $this->getPeerData();

        foreach ($this->getPeerData()->slice(0, 2) as $p) {
            $SI = getTicker($p);
            $SI->pullIEXPeers();

            foreach ($SI->getPeerData() as $pp) {
                $new->push($pp);
            }
        }
        $this->peer_data = json_encode($new->toArray());
        $this->pullIEXPeers();
    }


    public function addExistingPeers()
    {
        $new = $this->getPeerData();
        $random = SecCompare::all()->where('ticker2', $this->ticker)->where('ticker1', "<>", $this->ticker);
        //dd($random->first(), $random->random(), $random->last());
        foreach ($random as $SC) {
            if (!$new->contains($SC->ticker1)) {
                $new->push($SC->ticker1);
            }
        }

        $this->peer_data = json_encode($new->toArray());
        $this->pullIEXPeers();
    }






    /////////////// stats functions /////////

    public function calcR2($SI)
    {
        $regression = new LeastSquares();
        $regression->train($prices1, $prices2);
        dd($regression);
        //return $regression->getCoefficients()[0];
    }

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
