<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;

class Overview extends Component
{
    public $stocks;

    public function render()
    {
        $this->stocks = Stock::all();
        return view('livewire.overview');
    }
}
