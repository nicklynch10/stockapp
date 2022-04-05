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
    public $totalSavingsRealized;
    public $totalTaxableGainLoss;
    public $totalUnrealizedGainLoss;
    public $harvestableLosses;
    public $unrealizedGain;
    public $box2;
    public $box3;
    public $taxable;
    public $gain;
    public $nagative;
    public $positive;

    public function render()
    {
        $this->sto = Stock::select('stock_ticker','current_share_price',DB::raw("(sum(share_number)) as total_stock"))->where('user_id',Auth::user()->id)->groupBy('stock_ticker','current_share_price')->get();
        $this->totalSavingsRealized=0;

        $this->tran = Stock::join('transaction','transaction.stock_id','stock.id')->where('stock.user_id',Auth::user()->id)->get();
        $this->date=Transaction::select('date_of_transaction')->where('user_id',Auth::user()->id)->groupBy('date_of_transaction')->get();

        //Box 2
        $this->box2=Stock::join('transaction','transaction.stock_id','stock.id')->where('stock.user_id',Auth::user()->id)->whereYear('stock.date_of_purchase', '=', date('Y'))->orderBy('transaction.date_of_transaction','DESC')->get();
        $taxable=0;
        foreach($this->box2 as $b2)
        {
            $taxable+=($b2->share_price-$b2->ave_cost)*($b2->stock);
        }
        $this->totalTaxableGainLoss=$taxable;
        //Box 3
        $box3=Stock::join('view_stock_update','view_stock_update.stock_id','stock.id')->where('user_id',Auth::user()->id)->get();
        $nagative=0;
        $positive=0;
        foreach($box3 as $b3)
        {
            if($b3->current_total_value-$b3->total_cost<0)
            {
                //Box4
                $nagative+=abs($b3->current_total_value-$b3->total_cost);
            }
            else
            {
                //Box5
                $positive+=abs($b3->current_total_value-$b3->total_cost);
            }
        }
        $this->totalUnrealizedGainLoss=$positive-$nagative;
        $this->harvestableLosses=$nagative;
        $this->unrealizedGain=$positive;

        return view('livewire.overview');
    }
}
