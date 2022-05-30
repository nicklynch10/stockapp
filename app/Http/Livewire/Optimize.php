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

    public function render()
    {
        $optimizeLoss = [];
        $topLoss = [];
        $stock = Stock::select('stock.*','account.account_name')->join('account','account.id','stock.account_id')->where('stock.user_id', Auth::user()->id)->get();
        foreach ($stock as $st)
        {
            $transaction = Transaction::where('stock_id', $st->id)->get();
            foreach ($transaction as $t)
            {
                if($t->type == 0)
                {
                    $totalBuy = $t->stock * $t->share_price;
                }
                elseif ($t->type == 1)
                {
                    $totalSell = $t->stock * $t->share_price;
                }
            }
            if($totalBuy > $totalSell)
            {
                $dLoss = abs($totalSell - $totalBuy);
                $pLoss = abs(($totalSell/$totalBuy)*100);
                array_push($topLoss,["id" => $st->id,"dloss" => $dLoss, 'ploss' => $pLoss]);
                arsort($topLoss);
                array_push($optimizeLoss,$st);
            }
        }
        return view('livewire.optimize',['optimizeLoss' => $optimizeLoss, 'toploss' => $topLoss]);
    }
}
