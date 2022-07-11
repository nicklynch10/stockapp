<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompsList extends Component
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
    public $companyname = "";
    public $time;

    public $SI;

    public function init2()
    {
        $this->loadData = true;
        //dd("here");
        $this->updatedTicker();
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function mount($tickerData)
    {
        if($tickerData != null){
            $this->ticker = $tickerData;
        }
        else{
            $this->ticker = "TSLA";
        }
        /// this was provided by the user. Please make sure this is secure...
        // run laravel security measures before using user input into our database
        // otherwise it is easy for the app to be hacked
        $this->SI = getTicker($this->ticker);
        $this->companyname = $this->SI->company_name;
        $this->updatedTicker();
        $this->loadData = true;
    }

    public function render()
    {
        try {
            return view('livewire.comps-list');
        } catch (Exception $e) {
            return view('livewire.comps-list');
        }
    }


    public function updatedTicker()
    {
        if ($this->loadData) {
            $relation = long_sec_update($this->ticker);
            //dd($relation);
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
                $this->list_comps();
            }
            //dd($this->stock_cors);
        }
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
        //dd("2");
        //$this->dispatchBrowserEvent('contentChanged');
    }

    public function showETFs()
    { //toggles to show ETFs
        //dd($this);
        //dd("1");
        if ($this->etfs) {
            $this->etfs = false;
        } else {
            $this->etfs = true;
        }
        $this->list_comps();
    }
}
