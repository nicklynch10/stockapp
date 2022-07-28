<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\SecCompare;
use App\Models\SecInfo;
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
    public $box3;
    public $nagative = 0;
    public $harvestableLosses = 0;
    public $potentialSavings = 0;
    public $sortBy;
    protected $listeners = ['reloadIgnore' => 'render', 'refreshOptimize' => 'render'];
    public $stock;
    public $stockData;
    public $confirmIgnoreSection = false;
    public $confirmCompleteSection = false;
    public $confirmSection = false;

    public function mount()
    {
        $this->sortBy = "";
    }

    public function render()
    {
        $nagative = 0;
        $this->potentialSavings = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock',0)->where('ave_cost', '>', 'current_share_price')->where('stock.user_id', Auth::user()->id)->with('account','viewupdatestock')
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange','<','-3')
                    ->where('total_gain_loss','<',0);
            })
            ->get();
        foreach($this->potentialSavings as $b3)
        {
            if($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost<0)
            {
                $nagative += abs($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost);
            }
        }
        $this->harvestableLosses = $nagative;

        return view('livewire.optimize');
    }

}
