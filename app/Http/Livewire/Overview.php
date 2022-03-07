<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
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
        $this->sto = Stock::where('user_id',Auth::user()->id)->get();
        $this->tran = Transaction::all();

        return view('livewire.overview');
    }
}
