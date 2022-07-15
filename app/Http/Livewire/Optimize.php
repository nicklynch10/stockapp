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
    public $stock;
    public $confirmIgnoreSection = false;
    public $confirmCompleteSection = false;
    public $confirmSection = false;

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
        $ignore = [];
        if ($this->sortBy) {
            $stock = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->where('account_id', $this->sortBy)->with('account')->paginate(10);
        } else {
            $stock = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('stock.user_id', Auth::user()->id)->with('account')->get();
        }

        foreach ($stock as $st) {
            $dLosss = ($st->current_share_price * $st->share_number) - ($st->ave_cost * $st->share_number);
            $pLoss = abs((($st->ave_cost / $st->current_share_price)-1)*100);
            $potentialSavings = $dLosss * 40 / 100;
            if($dLosss < 0 && $pLoss > 3)
            {
//                $sto = [];
//                $et = [];
//                if ($st->type == 0) {
//                    $data = SecInfo::where('ticker', $st->stock_ticker)->latest()->first();
//
//                    if (!isset($data) ||
//                        (isset($data) && isset($data->peer_data)
//                            && collect(json_decode($data->peer_data))->isEmpty())
//                    ) {
//                        $data = quick_sec_update($st->stock_ticker);
//                    }
//
//                    if (isset($data) && $data->peer_data != null) {
//                        foreach (json_decode($data->peer_data) as $p) {
//                            if (count($et) > 3 && count($sto) > 3) {
//                                break;
//                            }
//                            $SC = SecCompare::where(['ticker1' => $st->stock_ticker , 'ticker2' => $p])->latest()->first();
//
//                            if (isset($SC)) {
//                                if ($SC->correlation > 0) {
//                                    if (getTicker($p)->type != "ETF") {
//                                        if (count($sto)<4) {
//                                            array_push($sto, $SC->ticker2);
//                                        }
//                                    } elseif (getTicker($p)->type == "ETF") {
//                                        if (count($et)<4) {
//                                            array_push($et, $SC->ticker2);
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
                if($st->ignore_stock == 0)
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
//                            "compare_stock" => json_encode($sto),
//                            "compare_eft" => json_encode($et)
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
//                            "compare_stock" => json_encode($sto),
//                            "compare_eft" => json_encode($et)
                        ]
                    );
                }
                elseif ($st->ignore_stock == 2)
                {
                    array_push(
                        $ignore,
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
//                            "compare_stock" => json_encode($sto),
//                            "compare_eft" => json_encode($et)
                        ]
                    );
                }
            }
            $psaving = array_column($topLoss, 'potentialSavings');
            array_multisort($psaving, SORT_DESC, $topLoss);
        }

        $this->account = Account::where('user_id', Auth::user()->id)->get();
        return view('livewire.optimize', ['toploss' => $topLoss, 'stockLink' => $stock, 'completeIgnore' => $completeIgnore, 'ignore' => $ignore]);
    }

    public function confirmIgnoreSection($stockId)
    {
        $this->stock = Stock::find($stockId);
        if ($this->stock) {
            $this->confirmIgnoreSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelIgnoreSection()
    {
        $this->confirmIgnoreSection = false;
    }

    public function ignoreSection()
    {
        if ($this->confirmIgnoreSection) {
            $this->stock->update([
                'ignore_stock' => 2,
            ]);
            $this->reset(['stock', 'confirmIgnoreSection']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'danger',
                'message' => 'Ignore Section',
            ]);
        }
    }

    public function confirmCompleteSection($stockId)
    {
        $this->stock = Stock::find($stockId);
        if ($this->stock) {
            $this->confirmCompleteSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelCompleteSection()
    {
        $this->confirmCompleteSection = false;
    }

    public function completeSection()
    {
        if ($this->confirmCompleteSection) {
            $this->stock->update([
                'ignore_stock' => 1,
            ]);
            $this->reset(['stock', 'confirmCompleteSection']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'success',
                'message' => 'Complete Section',
            ]);
        }
    }

    public function confirmSection($stockId)
    {
        $this->stock = Stock::find($stockId);
        if ($this->stock) {
            $this->confirmSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelSection()
    {
        $this->confirmSection = false;
    }

    public function section()
    {
        if ($this->confirmSection) {
            $this->stock->update([
                'ignore_stock' => 0,
            ]);
            $this->reset(['stock', 'confirmSection']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'success',
                'message' => 'Section Succesfullay',
            ]);
        }
    }
}
