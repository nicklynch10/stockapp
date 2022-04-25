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
        $stock->pullIEXPeers();
        // echo "<br> Done with OG peers";
        // print_r($stock->getPeerData());
        if ($stock->getPeerData() && $stock->getPeerData()->count()<15) {
            $stock->addRelatedPeers();
            $stock->addRelatedPeers();
            // echo "<br> Done with related peers";
            // print_r($stock->getPeerData());
        }


        $stock->addExistingPeers();
        $stock->addRandomPeers(10);
        // echo "<br> Done with existing peers";
        // print_r($stock->getPeerData());
        $this->comps = $stock->getPeerData();
        //dd($this->comps);

        $stocks = collect([]);
        $cors = collect([]);

        foreach ($this->comps as $p) {
            $SC = $stock->compareToTicker($p);
            $SI1 = $SC->SI2;
            if ($SC->correlation>0) {
                // adds to the list only if they find correlation data

                if ($this->etfs || getTicker($p)->type != "et") {
                    // checks if ETF toggle is on
                    $stocks->push($SI1);
                    $cors->push($SC);
                }
            }
        }

        $this->correlations = $cors;
        $this->stocks = $stocks;
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
