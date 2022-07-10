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
    public bool $loadData = false;


    public function init()
    {
        $this->loadData = true;
        $this->get_factors();
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

            //////
            $f = getFactor("VDC", "VCR", "-");
            $f->name = "Cyclical => Defensive";
            $f->save();
            $this->factors->push($f);
            //// New addition 7/10/2022

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
}
