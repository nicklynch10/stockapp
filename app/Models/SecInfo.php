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
    public $range = "3m";
    public $index = "SPY";
    public $debug = false;

    public function __construct()
    {
        $this->token = env('IEX_CLOUD_KEY', null);
        $this->endpoint = env('IEX_CLOUD_ENDPOINT', null);
    }

    public function getIEXData()
    {
        $debug = $this->debug;

        // only requests data from IEX if it has not been requested yet today
        if ($this->date_updated == Carbon::today()->format("Y-m-d") && isset($this->info_data)) {
            //echo "<br>found ".$this->ticker;
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

        //dd($stats);

        $this->beta = $stats['beta'];
        $this->div_yield = $stats['dividendYield'];
        $this->company_name = $stats['companyName'];
        $this->peRatio = $stats['peRatio'];
        $this->year1ChangePercent = $stats['year1ChangePercent'];
        $this->marketcap = $stats['marketcap']/1000;
        $this->info_data = json_encode($data->json());
        $this->week52Low = $stats["week52low"];
        $this->week52High = $stats["week52high"];
        //$this->iexClose = $stats["iexClose"];



        //sends a get request to IEX for more company info
        $url = ($this->endpoint . 'stable/stock/'.$this->ticker.'/company?token=' . $this->token);
        $data = Http::get($url);

        // extracts and saves data
        $stats = $data->json();
        if (!isset($stats)) {
            return "more company info query failed";
        }


        $this->type = convertType($stats["issueType"], false);
        $this->security_name = $stats["securityName"];
        $this->industry = $stats["industry"];
        $this->sector = $stats["sector"];
        $this->company_tags = json_encode($stats["tags"]);
        $this->company_data = json_encode($stats);


        //sends a get request to IEX for historical data
        if ($debug) {
            echo "<br>pulling ".$this->ticker;
        }

        $url = $this->endpoint . 'stable/stock/'.$this->ticker.'/chart/'.$this->range.'?token=' . $this->token;

        $data = Http::get($url);
        $stats = $data->json();
        if (!isset($stats)) {
            return "historical query failed";
        }

        $historical_data = collect($data->json());
        if ($debug) {
            echo "<br>got data ";
        }//.json_encode($stats);

        //stores all of the data in a json text string.
        $this->historical_data = json_encode($historical_data);
        $this->change_data = json_encode($historical_data->pluck("changePercent")->map(function ($item) {
            return $item*100; // multiplies by 100
        })->toArray());
        $this->price_data = json_encode($historical_data->pluck("close")->toArray());
        $this->date_data = json_encode($historical_data->pluck("date")->toArray());
        $this->volume_data = json_encode($historical_data->pluck("volume")->toArray());
        // use the pluck function to extract a single datapoint
        //echo "<br>here1";
        // calculates the Standard Deviation
        $this->date_updated = Carbon::today()->format("Y-m-d");

        //$this->std = $this->Standard_Deviation($this->getChangeData());
        if ($this->getChangeData()->count()>0) {
            $this->std = StandardDeviation::population($this->getChangeData()->toArray());
            if ($debug) {
                echo "<br> Calculated STD for ".$this->ticker." = ".$this->std;
            }
        } else {
            $this->std = 0;
            if ($debug) {
                echo "<br> No data found. STD = 0";
            }
        }
        if ($this->ticker == $this->index) {
            if ($debug) {
                echo "<br> Ticker = index - calced_beta = 1";
            }
            $this->calced_beta = 1;
        } else {
            if ($debug) {
                echo "<br> calculating Beta";
            }
            $this->calced_beta = $this->calcBeta();
            if ($debug) {
                echo "<br> calculating Beta for ".$this->ticker." as ".$this->calced_beta;
            }
        }
        if ($debug) {
            echo "<br>Done with the pull - saving down";
        }
        // saves for future use
        $this->save();
    }


    public function calcBeta()
    {
        //calculates beta using the S&P 500
        $ticker = $this->index;
        //initialize a SecInfo model
        $SPY = getTicker($ticker);
        $SC = $this->compareToTicker($ticker);
        //dd($SC);
        $SI1 = $SPY;
        $p = $SC->correlation;
        $beta = $p*$SI1->std*$this->std;
        //$beta = $this->getCovariance($SI1->getChangeData(), $this->getChangeData());
        return $beta;
    }

    public function compareToTicker($ticker)
    {
        $debug = $this->debug;
        //checks if the comparison has already been made within [30] days
        $SC_old = SecCompare::where('ticker2', $this->ticker)->where('ticker1', $ticker)->first();
        if (!$SC_old) {
            $SC_old = SecCompare::where('ticker1', $this->ticker)->where('ticker2', $ticker)->first();
        }


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
            return $SC_old; //returns the existing correlation...
        } elseif ($ticker == $this->ticker) {
            if ($debug) {
                echo "<br> same ticker using 1 for ".$this->ticker." and ".$ticker." at ".now();
            }
            $p = 1;
            $SI1 = $this;
        } else {
            //initialize a SecInfo model

            $SI1 = getTicker($ticker);
            //dd($SI1);
            if ($SI1->getDateData()->first() != $this->getDateData()->first()) {
                //dd("Sec dates did not match");
                $p = 0;
            } elseif ($SI1->getChangeData()->count() != $this->getChangeData()->count()) {
                $p = 0;
            } else {
                if ($debug) {
                    echo "<br>no p found. Creating new p for ".$this->ticker." and ".$ticker." at ".now();
                }
                $p = Correlation::pearson($SI1->getChangeData()->toArray(), $this->getChangeData()->toArray());
            }
        }
        $this->save();


        $SC = new SecCompare();
        $SC->SI1()->associate($this);
        $SC->SI2()->associate($SI1);
        //dd($SI1, $SC, $this);
        $SC->ticker1 = $this->ticker;
        $SC->ticker2 = $SI1->ticker;
        $SC->correlation = $p;
        $SC->range = $this->range;
        $SC->amount = $this->getChangeData()->count();
        $SC->save();

        if ($ticker == "SPY") {
            //dd($SC, $this);
        }

        return $SC;
    }

    public function compareToFactor($factor)
    {
        $factor = Factor::find($factor["id"]);

        //checks if the comparison has already been made within [30] days
        $SC_old = FactorCompare::where('ticker', $this->ticker)->where('factor_id', $factor->id)->first();
        if ($SC_old && $SC_old->updated_at > now()->addDays(-30)) {
            return $SC_old;
        }
        $this->getIEXData();

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
            $new = $this->getPeerData();  // starts with existing peer data and adds new ones

            if (count($new) > 0) {
                $new3 = collect([]);
                foreach ($new as $t) {
                    if ($t != $this->ticker) {
                        $new3->push($t);
                    }
                }
                $this->peer_data = json_encode($new3);
            } else {
                $this->peer_data = json_encode($peers);
            }
        }
        $this->sortPeers();
        $this->save();

        return $this->IEXpeer_data;
    }

    public function sortPeers()
    {

        //sorts by correlation
        // cleans the peer data for valid peers only
        $this->filterPeerData();
        $new = $this->getPeerData();  // starts with existing peer data and adds new ones

        $new2 = collect([]);
        $SCs = collect([]);
        foreach ($new as $p) {
            $SC = $this->compareToTicker($p);
            if (isset($SC->correlation) && $SC->correlation != 0 && !$new2->contains($p) && $SC->ticker1 != $SC->ticker2) {
                if ($p != $this->ticker) {
                    $new2->push($p);
                    $SCs->push($SC);
                }
            }
        }

        // sorts by correlation
        $new3 = collect([]);
        foreach ($SCs->sortByDesc("correlation") as $p) {
            $new3->push($p->ticker2);
        }



        $this->peer_data = json_encode($new3->toArray());
        $this->save();
    }


    public function addRelatedPeers()
    {
        $this->pullIEXPeers();
        $new = $this->getPeerData();

        if ($this->getPeerData()->count() < 1) {
            return;
        }

        // chooses one of the top 5 peers
        foreach ($this->getPeerData()->slice(0, 5)->random(1) as $p) {
            $SI = getTicker($p);
            $SI->pullIEXPeers();
            //dd($SI);

            // adds new peers in
            foreach ($SI->getPeerData() as $pp) {
                if ($pp != $this->ticker) {
                    $new->push($pp);
                }
            }
        }
        $this->peer_data = json_encode($new->toArray());
        $this->sortPeers();
    }


    public function addExistingPeers()
    {
        $new = $this->getPeerData();
        $random = SecCompare::where('ticker2', $this->ticker)->where('ticker1', "<>", $this->ticker)->get();
        //dd($random->first(), $random->random(), $random->last());
        foreach ($random as $SC) {
            if (!$new->contains($SC->ticker1)) {
                $new->push($SC->ticker1);
            }
        }

        $random = SecCompare::where('ticker1', $this->ticker)->where('ticker2', "<>", $this->ticker)->get();
        //dd($random->first(), $random->random(), $random->last());
        foreach ($random as $SC) {
            if (!$new->contains($SC->ticker2) && $SC->ticker2 != $this->ticker) {
                $new->push($SC->ticker2);
            }
        }


        $this->peer_data = json_encode($new->toArray());
        $this->sortPeers();
    }


    public function addRandomPeers($n)
    {
        //adds random peers (of data that has been pulled already)
        $new = $this->getPeerData();
        // filters through all data and chooses only ones that have been updated within [10] days
        $random = SecInfo::where('ticker', "<>", $this->ticker)->where("updated_at", ">", now()->addDays(-10))->get();

        //dd($random->pluck('ticker'), $new);

        if (!$random) {
            return "No data found in random pull";
        }

        // gets the min of amount found and ones added
        $amt = min($n, $random->count());

        //adds them into the peer set
        foreach ($random->random($amt) as $SC) {
            if (!$new->contains($SC->ticker) && $SC->ticker != $this->ticker) {
                $new->push($SC->ticker);
            }
        }


        $this->peer_data = json_encode($new->toArray());
        $this->sortPeers();
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

    public function filterPeerData()
    {
        $new = $this->getPeerData();
        $new2 = collect(json_decode("[]"));
        foreach ($new as $t) {
            if ($t != $this->ticker) {
                $new2->push($t);
            }
        }
        $this->peer_data = json_encode($new2->toArray());
    }

    public function getIEXPeerData()
    {
        return collect(json_decode($this->IEXpeer_data));
    }

    public function getLogo()
    {
        $token = $this->token;
        $endpoint = $this->endpoint;
        $logo = Http::get($endpoint . 'stable/stock/' . $this->ticker . '/logo?token=' . $token);
        $logo_url = $logo->json();
        $tickerLogo = $logo_url ? $logo_url['url'] : '';
        $string = $tickerLogo;
        if (strpos($string, "http") === 0) {
            $logoUrl = $tickerLogo;
        } else {
            $logoUrl = 'https://ui-avatars.com/api/?name='.$this->ticker.'&color=7F9CF5&background=EBF4FF';
        }
        $this->logoUrl = $logoUrl;
        $this->save();
        return $logoUrl;
    }

    public function getCurrentSharePrice()
    {
        $token = $this->token;
        $endpoint = $this->endpoint;
        $url = ($endpoint . 'stable/stock/'.$result->ticker2.'/quote?token=' . $token);
        $data = Http::get($url);
        $stats = $data->json();
    }


    /////////////// stats functions /////////

    public function calcR2($SI)
    {
        $regression = new LeastSquares();
        $regression->train($prices1, $prices2);
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
