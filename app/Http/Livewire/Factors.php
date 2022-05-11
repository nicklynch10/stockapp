<?php

namespace App\Http\Livewire;

use Livewire\Component;


class Factors extends Component
{
    public $correlations = [];
    public $factors = [];
    public $ticker = 'SPHB';
    public $company;
    public $description;
    public $sector;
    public $type;
    public $tag;
    public $logo;
    protected $queryString = ['ticker'];


    public function render()
    {
        return view('livewire.factors');
    }

    public function mount()
    {
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
    }

    public function updatedTicker()
    {

        $SI = getTicker($this->ticker);
        $this->correlations = collect([]);

        foreach ($this->factors as $f) {
            $FC = $SI->compareToFactor($f);
            $this->correlations->push($FC);
        }
    }




}
