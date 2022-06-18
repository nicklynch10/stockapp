<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\StockTicker;
use Capsule\Request;
use Exception;
use http\QueryString;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class FactorDetail extends Component
{
    public $correlations = [];
    public $factors = [];
    public $ticker = "TSLA";
    public $company;
    public $description;
    public $sector;
    public $type;
    public $tag;
    public $logo;

    public $comps = [];
    public $correlation = [];
    public $etfs;
    public $is_first_load = true;
    public bool $loadData = false;

    public function init()
    {
        $this->loadData = true;
    }

    public function mount()
    {
        $this->ticker = $_GET['ticker'];
        $stockdata = StockTicker::where('ticker',$this->ticker)->first();
        if($stockdata == null)
        {
            $this->ticker = "TSLA";
        }
        else
        {
            $this->ticker = $_GET['ticker'];
        }
    }

    public function render()
    {
        try {
            if ($this->loadData) {
                $this->factors = collect($this->factors);
                $this->correlations = collect($this->correlations);

                $f = getFactor("VTV", "VUG", "-");
                $f->name = "Growth => Value";
                $f->save();
                $this->factors->push($f);

                $f = getFactor("MGC", "VB", "-");
                $f->name = "Small Cap => Large Cap";
                $f->save();
                $this->factors->push($f);

                $f = getFactor("VEA", "VWO", "-");
                $f->name = "Emerging => Developed";
                $f->save();
                $this->factors->push($f);

                $f = getFactor("MTUM", "NIFE", "-");
                $f->name = "Lagging => Momentum";
                $f->save();
                $this->factors->push($f);

                $f = getFactor("SPHB", "USMV", "-");
                $f->name = "Low Volatility => High Volatility";
                $f->save();
                $this->factors->push($f);

                $f = getFactor("VT", "BNDW", "-");
                $f->name = "Fixed Income => Equities";
                $f->save();

                $this->factors->push($f);
                $this->updatedTicker();
                $this->dispatchBrowserEvent('contentChanged');
            }
            return view('livewire.factor-detail');
        }catch(Exception $e)
        {
            return view('livewire.factor-detail');
        }
    }


    public function updatedTicker()
    {
        $stock = getTicker($this->ticker);
        $this->correlations = collect([]);
        foreach ($this->factors as $f) {
            $FC = $stock->compareToFactor($f);
            if ($FC !== null) {
                //                dd($this->correlations->push($FC));
                $this->correlations->push($FC);
            }
        }

        if ($stock->info_data) {
            if ($this->is_first_load) {
                // prevents loading on the first load. THis was causing timeout errors
                $this->is_first_load = false;
            } elseif (!$stock->IEXpeer_data) {
                $stock->pullIEXPeers();
            } else {
                $stock->addRelatedPeers();
            }

            $stock->addExistingPeers();
            $stock->addRandomPeers(30);
            // echo "<br> Done with existing peers";
            // print_r($stock->getPeerData());
            $this->comps = $stock->getPeerData();
            //dd($this->comps);

            $cors = collect([]);

            foreach ($this->comps as $p) {
                $SC = $stock->compareToTicker($p);
                if ($SC->correlation > 0) {
                    // adds to the list only if they find correlation data
                    if ($this->etfs && getTicker($p)->type == "ETF") {
                        // if etf toggle is true and type is etf, then adds to list
                        $cors->push($SC);
                    } elseif (!$this->etfs && getTicker($p)->type != "ETF") {
                        // if etf toggle is false and type is not etf, then adds to list
                        $cors->push($SC);
                    }
                }
            }
            $this->correlation = $cors;
        }
    }

    public function showETFs()
    { //toggles to show ETFs


        if ($this->etfs) {
            $this->etfs = false;
        } else {
            $this->etfs = true;
        }
        $this->updatedTicker($this->ticker);
    }
}
