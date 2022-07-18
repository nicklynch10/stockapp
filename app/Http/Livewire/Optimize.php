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
        $box3 = Stock::where('user_id', Auth::user()->id)->where('ignore_stock',0)->with('viewupdatestock')->get();
        $nagative = 0;
        foreach($box3 as $b3)
        {
            if($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost<0)
            {   //Box4
                $nagative += abs($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost);
            }
        }
        $this->harvestableLosses=$nagative;


        if ($this->sortBy) {
            $this->stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->where('account_id', $this->sortBy)->with('account')->paginate(10);
        } else {
            $this->stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->with('account')->get();
        }

//        foreach ($stockData as $st) {
//            $dLosss = ($st->current_share_price * $st->share_number) - ($st->ave_cost * $st->share_number);
//            $pLoss = abs((($st->current_share_price / $st->ave_cost)-1)*100);
//            $potentialSavings = $dLosss * 40 / 100;
//            if($dLosss < 0 && $pLoss > 3)
//            {
//                if ($st->type == 0) {
//                    $getCompareData = getRelated_stock_etf($st->stock_ticker);
//                }
//                if($st->ignore_stock == 0)
//                {
//                    array_push(
//                        $topLoss,
//                        [
//                            "id" => $st->id,
//                            "dloss" => $dLosss,
//                            "ploss" => $pLoss,
//                            "potentialSavings" => $potentialSavings,
//                            "ticker" => $st->stock_ticker,
//                            "company_name" => $st->company_name,
//                            "dateofpurchase" => $st->date_of_purchase,
//                            "long_term_gain" => $st->total_long_term_gains,
//                            "ticker_logo" => $st->ticker_logo,
//                            "account" => $st->account->account_name,
//                            "share_number" => $st->share_number,
//                            "security_name" => $st->security_name,
//                            "issuetype" => $st->issuetype,
//                            "compare_stock" => json_encode($getCompareData['stock']),
//                            "compare_eft" => json_encode($getCompareData['etf'])
//                        ]
//                    );
//                }
//                elseif ($st->ignore_stock == 1)
//                {
//                    array_push(
//                        $completeIgnore,
//                        [
//                            "id" => $st->id,
//                            "dloss" => $dLosss,
//                            "ploss" => $pLoss,
//                            "potentialSavings" => $potentialSavings,
//                            "ticker" => $st->stock_ticker,
//                            "company_name" => $st->company_name,
//                            "dateofpurchase" => $st->date_of_purchase,
//                            "long_term_gain" => $st->total_long_term_gains,
//                            "ticker_logo" => $st->ticker_logo,
//                            "account" => $st->account->account_name,
//                            "share_number" => $st->share_number,
//                            "security_name" => $st->security_name,
//                            "issuetype" => $st->issuetype,
//                            "compare_stock" => json_encode($getCompareData['stock']),
//                            "compare_eft" => json_encode($getCompareData['etf'])
//                        ]
//                    );
//                }
//                elseif ($st->ignore_stock == 2)
//                {
//                    array_push(
//                        $ignore,
//                        [
//                            "id" => $st->id,
//                            "dloss" => $dLosss,
//                            "ploss" => $pLoss,
//                            "potentialSavings" => $potentialSavings,
//                            "ticker" => $st->stock_ticker,
//                            "company_name" => $st->company_name,
//                            "dateofpurchase" => $st->date_of_purchase,
//                            "long_term_gain" => $st->total_long_term_gains,
//                            "ticker_logo" => $st->ticker_logo,
//                            "account" => $st->account->account_name,
//                            "share_number" => $st->share_number,
//                            "security_name" => $st->security_name,
//                            "issuetype" => $st->issuetype,
//                            "compare_stock" => json_encode($getCompareData['stock']),
//                            "compare_eft" => json_encode($getCompareData['etf'])
//                        ]
//                    );
//                }
//            }
//            $psaving = array_column($topLoss, 'potentialSavings');
//            array_multisort($psaving, SORT_DESC, $topLoss);
//        }

        $this->account = Account::where('user_id', Auth::user()->id)->get();
        return view('livewire.optimize');
    }

}
