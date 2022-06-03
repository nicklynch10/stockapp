<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Optimize extends Component
{
    public $totalBuy = 0;
    public $totalSell = 0;
    public $dLoss = 0;
    public $pLoss = 0;
    public $potentialSavings = 0;

    public function render()
    {
        $topLoss = [];

        $stock = Stock::select('stock.*','account.account_name')->join('account','account.id','stock.account_id')->where('current_share_price','<>',0)->where('ave_cost','<>',0)->where('stock.user_id', Auth::user()->id)->get();
        foreach ($stock as $st)
        {
            $totalSell = 0;
            $totalBuy = 0;
            $totalPbuy = $st->current_share_price;
            $totalPSell = $st->ave_cost;
            $transaction = Transaction::where('stock_id',$st->id)->get();
            foreach ($transaction as $t)
            {
                if($t->type == 0)
                {
                    $totalBuy = $t->share_price;
                    $totalShare = $t->stock;
                }
                elseif ($t->type == 1)
                {
                    $totalSell = $t->share_price;
                }
            }
            if($totalBuy!=0 && $totalBuy > $totalSell)
            {
                $dLoss = abs($totalSell - $totalBuy)*$totalShare;
                $pLoss = abs((($totalPSell/$totalPbuy)-1)*100);
                $potentialSavings = $dLoss*40/100;
                array_push($topLoss,
                    [
                        "id" => $st->id,
                        "dloss" => $dLoss,
                        "ploss" => $pLoss,
                        "potentialSavings" => $potentialSavings,
                        "ticker" => $st->stock_ticker,
                        "company_name" => $st->company_name,
                        "dateofpurchase" => $st->date_of_purchase,
                        "long_term_gain" => $st->total_long_term_gains,
                        "ticker_logo" => $st->ticker_logo,
                        "account" => $st->account_name,
                    ]);
                $psaving = array_column($topLoss, 'potentialSavings');
                array_multisort($psaving, SORT_DESC, $topLoss);
            }
        }
        return view('livewire.optimize',['toploss' => $topLoss]);
    }
}
