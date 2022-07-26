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
    public $saving = 0;
    public $positive;

    public function render()
    {
        //  Pie chart
        $this->sto = Stock::selectRaw('stock_ticker, SUM(share_number) as total_stock')->where('user_id',Auth::user()->id)
                            ->whereNotNull('current_share_price')->groupBy('stock_ticker')->get();

        // Line chart
        $this->tran = Stock::join('transaction','transaction.stock_id','stock.id')->where('stock.user_id',Auth::user()->id)->whereYear('stock.date_of_purchase', '=', date('Y'))->get();
        $this->date = Transaction::select('date_of_transaction')->where('user_id',Auth::user()->id)->whereYear('date_of_transaction', '=', date('Y'))->groupBy('date_of_transaction')->orderBy('date_of_transaction','ASC')->get();

        $this->box2 = Stock::where('stock.user_id',Auth::user()->id)->get();
        // Box 1

        $saving = 0;
        foreach ($this->box2 as $bx2)
        {
            foreach ($bx2->transaction()->where('type',1)->get() as $t)
            {
                if($bx2->ave_cost > $t->share_price)
                {
                    $diffrence = $bx2->ave_cost - $t->share_price;
                    $saving += $diffrence * 40 /100;
                }
            }
        }
        $this->totalSavingsRealized = $saving;


        // Box 2
        $taxable = 0;
        foreach($this->box2 as $b2)
        {
            foreach ($b2->transaction()->where('type',1)
                         ->whereYear('date_of_transaction', '=', date('Y'))
                         ->orderBy('date_of_transaction','DESC')->get() as $t)
            {
                $taxable += ($t->share_price-$b2->ave_cost) * ($t->stock);
            }
        }
        $this->totalTaxableGainLoss=$taxable;

        //Box 3
        $box3 = Stock::where('user_id', Auth::user()->id)->with('viewupdatestock')->get();
        $nagative = 0;
        $positive = 0;
        foreach($box3 as $b3)
        {
            if($b3->viewupdatestock->total_gain_loss < 0)
            {   //Box4
                $nagative += abs($b3->viewupdatestock->total_gain_loss);
            }
            else
            {   //Box5
                $positive += $b3->viewupdatestock->total_gain_loss;
            }
        }
        $this->totalUnrealizedGainLoss = $positive - $nagative;
        $this->harvestableLosses = $nagative;
        $this->unrealizedGain = $positive;

        return view('livewire.overview');
    }
}
