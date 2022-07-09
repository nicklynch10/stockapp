<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FactorPlot extends Component
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
    public $etfs = false;
    public $is_first_load = true;
    public bool $loadData = false;
    public $stocks;
    public $StocksArray;
    public $ETFArray;
    public $stock_cors;
    public $etf_cors;

    public function init()
    {
        $this->loadData = true;
        $this->get_factors();
        $this->updatedTicker();
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function mount()
    {
        $this->ticker = $_GET['ticker'];
        /// this was provided by the user. Please make sure this is secure...
        // run laravel security measures before using user input into our database
        // otherwise it is easy for the app to be hacked
    }

    public function render()
    {
        try {
            return view('livewire.factor-plot');
        } catch (Exception $e) {
            return view('livewire.factor-plot');
        }
    }

    public function get_factors()
    {

        /// gets factor data. only needs to be done on first load
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

            $relation = getTicker($this->ticker);

            $this->correlations = collect([]);
            foreach ($this->factors as $f) {
                $FC = $relation->compareToFactor($f);
                if ($FC !== null) {
                    //dd($this->correlations->push($FC));
                    $this->correlations->push($FC);
                }
            }
        }
    }


    public function updatedTicker()
    {
        $relation = long_sec_update($this->ticker);

        if ($relation->info_data) {
            $this->comps = $relation->getPeerData();
            $this->StocksArray = collect([]);
            $this->ETFArray = collect([]);
            $this->stock_cors = collect([]);
            $this->etf_cors = collect([]);
            foreach ($this->comps as $p) {
                if (count($this->stock_cors) > 100 || count($this->etf_cors) > 100) {
                    break;
                }
                $SC = $relation->compareToTicker($p);
                $SI1 = $SC->SI2;
                if ($SC->correlation>0) {
                    // adds to the list only if they find correlation data
                    if (getTicker($p)->type == "ETF") {
                        //adds to etf list
                        $this->ETFArray->push($SI1);
                        $this->etf_cors->push($SC);
                    } elseif (getTicker($p)->type != "ETF") {
                        // adds to stock list
                        $this->StocksArray->push($SI1);
                        $this->stock_cors->push($SC);
                    }
                }
            }
        }

        $this->list_comps();
    }

    public function list_comps()
    {
        if ($this->etfs) {
            $this->correlation = $this->etf_cors;
            $this->stocks = $this->ETFArray;
        } else {
            $this->correlation = $this->stock_cors;
            $this->stocks = $this->StocksArray;
        }

        $this->dispatchBrowserEvent('contentChanged');
    }

    public function showETFs()
    { //toggles to show ETFs
        if ($this->etfs) {
            $this->etfs = false;
        } else {
            $this->etfs = true;
        }
        $this->list_comps();
    }
}
