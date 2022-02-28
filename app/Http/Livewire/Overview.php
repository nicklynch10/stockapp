<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use App\Models\Stock;

class Overview extends Component
{
    public $search;
    public $sortColumn;
    public $sortDirection;
    public $stocks;


    public function render()
    {
        $this->sto = Stock::all();
        $this->tran = Transaction::all();

        return view('livewire.overview');
    }
}
