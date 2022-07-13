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
    protected $listeners = ['reloadIgnore' => 'render'];

    public function mount()
    {
        $this->sortBy = "";
    }

    public function render()
    {
        $box3 = Stock::where('user_id', Auth::user()->id)->with('viewupdatestock')->get();
        $nagative = 0;
        foreach($box3 as $b3)
        {
            if($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost<0)
            {   //Box4
                $nagative += abs($b3->viewupdatestock->current_total_value - $b3->viewupdatestock->total_cost);
            }
        }
        $this->harvestableLosses=$nagative;


        $topLoss = [];
        $completeIgnore = [];
        if ($this->sortBy) {
            $stock = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->where('account_id', $this->sortBy)->with('account')->get();
        } else {
            $stock = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->with('account')->paginate(10);
        }

        foreach ($stock as $st) {
            $sto = [];
            $et = [];
            if ($st->type == 0) {
                $data = SecInfo::where('ticker', $st->stock_ticker)->latest()->first();

                if (!isset($data) ||
                    (isset($data) && isset($data->peer_data)
                        && collect(json_decode($data->peer_data))->isEmpty())
                ) {
                    $data = quick_sec_update($st->stock_ticker);
                }

                if (isset($data) && $data->peer_data != null) {
                    foreach (json_decode($data->peer_data) as $p) {
                        if (count($et) > 3 && count($sto) > 3) {
                            break;
                        }
                        $SC = SecCompare::where(['ticker1' => $st->stock_ticker , 'ticker2' => $p])->latest()->first();

                        if (isset($SC)) {
                            if ($SC->correlation > 0) {
                                if (getTicker($p)->type != "ETF") {
                                    if (count($sto)<4) {
                                        array_push($sto, $SC->ticker2);
                                    }
                                } elseif (getTicker($p)->type == "ETF") {
                                    if (count($et)<4) {
                                        array_push($et, $SC->ticker2);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $totalPbuy = $st->current_share_price;
            $totalPSell = $st->ave_cost;
            $dLosss = abs($st->current_share_price - $st->ave_cost)*$st->share_number;
            $pLoss = abs((($totalPSell/$totalPbuy)-1)*100);
            $potentialSavings = $dLosss*40/100;
            if($st->ignore_stock == 0 && $pLoss > 3)
            {
                array_push(
                    $topLoss,
                    [
                        "id" => $st->id,
                        "dloss" => $dLosss,
                        "ploss" => $pLoss,
                        "potentialSavings" => $potentialSavings,
                        "ticker" => $st->stock_ticker,
                        "company_name" => $st->company_name,
                        "dateofpurchase" => $st->date_of_purchase,
                        "long_term_gain" => $st->total_long_term_gains,
                        "ticker_logo" => $st->ticker_logo,
                        "account" => $st->account->account_name,
                        "share_number" => $st->share_number,
                        "security_name" => $st->security_name,
                        "issuetype" => $st->issuetype,
                        "compare_stock" => json_encode($sto),
                        "compare_eft" => json_encode($et)
                    ]
                );
            }
            elseif ($st->ignore_stock == 1)
            {
                array_push(
                    $completeIgnore,
                    [
                        "id" => $st->id,
                        "dloss" => $dLosss,
                        "ploss" => $pLoss,
                        "potentialSavings" => $potentialSavings,
                        "ticker" => $st->stock_ticker,
                        "company_name" => $st->company_name,
                        "dateofpurchase" => $st->date_of_purchase,
                        "long_term_gain" => $st->total_long_term_gains,
                        "ticker_logo" => $st->ticker_logo,
                        "account" => $st->account->account_name,
                        "share_number" => $st->share_number,
                        "security_name" => $st->security_name,
                        "issuetype" => $st->issuetype,
                        "compare_stock" => json_encode($sto),
                        "compare_eft" => json_encode($et)
                    ]
                );
            }
            $psaving = array_column($topLoss, 'potentialSavings');
            array_multisort($psaving, SORT_DESC, $topLoss);
        }

        $this->account = Account::where('user_id', Auth::user()->id)->get();
        return view('livewire.optimize', ['toploss' => $topLoss, 'stockLink' => $stock, 'completeIgnore' => $completeIgnore]);
    }

    public function addignoresection($ignoreStockId)
    {
        $findStock = Stock::find($ignoreStockId);
        $findStock->update([
           'ignore_stock' => 1,
        ]);
        $this->emit('reloadIgnore');
    }
}
