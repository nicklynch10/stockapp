<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HistoricalTrades extends Component
{
    use WithPagination;
    protected $listeners=['historicaldata'=>'render'];

    public function render()
    {
//        $data = Stock::join('transaction','transaction.stock_id','stock.id')->where('stock.user_id',Auth::user()->id)
//                    ->orderBy('transaction.date_of_transaction','DESC')
//                    ->orderBy('transaction.created_at','DESC')->paginate(10);

        $data = Transaction::where('user_id', Auth::user()->id)->orderBy('transaction.date_of_transaction','DESC')
            ->orderBy('transaction.created_at','DESC')->paginate(10);
        return view('livewire.historical-trades', ['tradesdata' => $data]);
    }

    public function company($id)
    {
        $this->emit('company',$id);
    }
}
