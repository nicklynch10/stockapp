<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\StockTicker;
use Illuminate\Support\Facades\Http;

class CheckCorrelations extends Component
{
    public $ticker = "TSLA";
    public $sector = [
        "VOX","VCR","VDC","VDE","VFH","VHT","VIS","VGT","VAW","VNQ","VPU", "F", "GM", "TM", "AAL","JETS","LUV","UAL","DAL"
    ];
    public $correlations = [];
    public $stocks = [];

    public function mount()
    {
        $this->updatedTicker();
    }

    public function render()
    {
        return view('livewire.check-correlations');
    }

    public function updatedTicker()
    {
        // $this->correlations = [1,2];
        // return;
        //dd("here");

        $ticker = $this->ticker;
        $stock = $this->findByTicker($ticker);

        $stocks = collect([]);
        $cors = collect([]);

        foreach ($this->sector as $p) {
            $SI1 = $this->findByTicker($p);
            $stocks->push($SI1);

            $SC = $stock->createCorrelation($SI1);
            $cors->push($SC);
        }
        //dd($cors);
        $this->correlations = $cors;
        $this->stocks = $stocks;
    }



    public function findByTicker($ticker)
    { // one of two identical functions. Other one is in the SecInfo model...
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

    public function doNothing()
    {
        //as promised
    }
}
