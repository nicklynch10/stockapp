<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use App\Models\Stock;

class Overview extends Component
{
    public $stocks;

    public function render()
    {
        $this->stocks = Stock::all();
        $this->transaction=Transaction::all();
        return view('livewire.overview');
    }
}
