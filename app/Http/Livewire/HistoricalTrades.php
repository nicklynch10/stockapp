<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class HistoricalTrades extends Component
{
    use WithPagination;

    public function render()
    {
        $data=Stock::join('transaction','transaction.s_id','stock.id')->orderBy('transaction.updated_at','DESC')->paginate(10);
        return view('livewire.historical-trades',['tradesdata'=>$data]);
    }
}
