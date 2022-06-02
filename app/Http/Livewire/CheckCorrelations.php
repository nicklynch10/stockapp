<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\StockTicker;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CheckCorrelations extends Component
{
    public $ticker = "TM";
    public $comps = [
        //"F", "GM", "TM", "AAL","JETS","LUV","UAL","DAL", "FB"
    ];
    public $correlations = [];
    public $stocks = [];
    public $etfs;
    public $is_first_load = true;

    public function mount(Request $request)
    {
        if ($request && $request->input('symbol') && $request->input('symbol') != $this->ticker) {
            $t = $request->input('symbol');
            $this->ticker = $t;
        }
        $this->updatedTicker();
    }

    public function render()
    {
        return view('livewire.check-correlations');
    }


    public function updatedTicker()
    {
        $stock = getTicker($this->ticker);
        if($stock->info_data)
        {
            if ($this->is_first_load) {
                // prevents loading on the first load. THis was causing timeout errors
                $this->is_first_load = false;
            } elseif (!$stock->IEXpeer_data) {
                $stock->pullIEXPeers();
            } else {
                $stock->addRelatedPeers();
            }

            $stock->addExistingPeers();
            $stock->addRandomPeers(100);
            // echo "<br> Done with existing peers";
            // print_r($stock->getPeerData());
            $this->comps = $stock->getPeerData();
            //dd($this->comps);

            $stocks = collect([]);
            $cors = collect([]);

            foreach ($this->comps as $p) {
                $SC = $stock->compareToTicker($p);
                $SI1 = $SC->SI2;
                if ($SC->correlation > 0) {
                    // adds to the list only if they find correlation data
                    if ($this->etfs && getTicker($p)->type == "ETF") {
                        // if etf toggle is true and type is etf, then adds to list
                        $stocks->push($SI1);
                        $cors->push($SC);
                    } elseif (!$this->etfs && getTicker($p)->type != "ETF") {
                        // if etf toggle is false and type is not etf, then adds to list
                        $stocks->push($SI1);
                        $cors->push($SC);
                    }
                }
            }
            $this->correlations = $cors;
            $this->stocks = $stocks;
        }
    }

    public function doNothing()
    {
        //as promised
    }

    public function showETFs()
    { //toggles to show ETFs


        if ($this->etfs) {
            $this->etfs = false;
        } else {
            $this->etfs = true;
        }
        $this->updatedTicker();
    }
}
