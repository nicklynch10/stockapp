<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Stock;
use DB;

class Overview extends Component
{
    public $search;
    public $sortColumn;
    public $sortDirection;
    public $stocks;


    public function render()
    {
//        $this->sto = Stock::where('user_id',Auth::user()->id)->get();
        $this->sto = Stock::select('stock_ticker',DB::raw("(sum(share_number)) as total_stock"))->where('user_id',Auth::user()->id)->groupBy('stock_ticker')->get();
        $this->tran = Transaction::all();
        $this->date=Transaction::select('date_of_transaction')->where('user_id',Auth::user()->id)->groupBy('date_of_transaction')->get();
        return view('livewire.overview');
    }
}
