<?php

namespace App\Http\Livewire;

use App\Models\StockTicker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\Account;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;

class Stocks extends Component
{
    public $user_id;
    public $stocks;
    public $company_name;
    public $description;
    public $sector;
    public $market_cap;
    public $current_share_price;
    public $average_cost;
    public $share_number;
    public $date_of_purchase;
    public $stock_id;
    public $note;
    public $isdeleteOpen = 0;

    public $isAveOpen=false;
    public $ticker = null;
    public $stock_ticker = null;
    public $current_price;
    public $price;
    public $account;
    public $account_type;
    public $tags;
    public $issuetype;
    public $security_name;
    public $symbol;
    public $tickerdata;
    public $lastInsertedID;
    public $insertid;
    public $type;
    public $stock;
    public $share_price;
    public $share_sold;
    public $date_of_transaction;
    public $alltags;
    public $diff;
    public $tickerorcompany;
    public $current_stock;
    public $final_stock;
    public $record;
    public $result;
    public $gettransaction;
    public $companyname;
    public $buyInsertid;
    public $lastBuyInsertedID;
    public $deletestock = false;

    public $openmodalval=0;
    public $avepricereadonly=0;
    protected $listeners=['AveModal'=>'openAveModal','edit' => 'edit'];


    public function render()
    {
        if ($this->tickerorcompany!=null && !isset($this->stock_id)) {
            $this->companyname = StockTicker::where('ticker', $this->tickerorcompany)
                ->first();
            if (!$this->companyname) {
                $this->companyname = StockTicker::where('ticker_company', 'like', '%' . $this->tickerorcompany . '%')
                    ->first();
            }
            $this->company_name=$this->companyname ? $this->companyname['ticker_company'] : '';
            $this->stock_ticker=$this->companyname ? $this->companyname['ticker'] : '';

            if ($this->companyname && $this->companyname['ticker']) {
                $token = env('IEX_CLOUD_KEY', null);
                $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                $symbol = Http::get($endpoint . 'stable/stock/'.$this->companyname['ticker'].'/company?token=' . $token);
                $company = $symbol->json();
                $this->description = $company ? $company['description'] : '';
                $this->sector = $company ? $company['sector'] : '';
                if (isset($company['issueType'])) {
                    if ($company['issueType']=='et') {
                        $this->issuetype="ETF";
                    } elseif ($company['issueType']=='ad') {
                        $this->issuetype="ADR";
                    } elseif ($company['issueType']=='cs') {
                        $this->issuetype="Common Stock";
                    } else {
                        $this->issuetype=$company['issueType'];
                    }
                }
                $this->tags=$company ? json_encode($company['tags']) : '';
                $this->security_name=$company ? $company['securityName'] : '';
                $current_price = Http::get($endpoint . 'stable/stock/' . $this->companyname['ticker'] . '/quote?token=' . $token);
                $price = $current_price->json();
                $this->current_share_price = $price ? $price['latestPrice'] : '';
                $this->market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
            }
        }
        $this->stocks=Stock::where('user_id', Auth::user()->id)->orderBy('date_of_purchase', 'DESC')->orderBy('created_at', 'DESC')->get();
        $this->gettransaction = Transaction::all();
        $this->account = Account::where('user_id', Auth::user()->id)->get();
        $this->emit('historicaldata');
        return view('livewire.stock');
    }


    public function create()
    {
        $this->emit('create');
//        $this->resetInputFields();
//        $this->openModal();
    }

    public function editStock($id)
    {
        $this->emit('editStock', $id);
    }


    public function delete($id)
    {
        Stock::find($id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type'=>'error',
            'message'=>'Stock Deleted Successfully.'
        ]);
        $this->closedeletestock();
        $this->closeModal();
    }

    public function deletestock($id)
    {
        $this->deleteid=$id;
        $this->deletestock=true;
    }

    public function closedeletestock()
    {
        $this->deletestock=false;
    }


    public function sell($id) // Sell Stock Functions
    {
        $this->emit('sell', $id);
    }

    public function buy($id) // Add Buy Stock Functions
    {
        $this->emit('buy', $id);
    }

    public function company($stockticker) // Company Detail Function
    {
        $this->emit('company', $stockticker);
    }

    public function openAveModal()
    {
        if ($this->openmodalval==0) {
            $this->isAveOpen = true;
        }
    }

    public function closeAveModal($id)
    {
        $this->openmodalval=$id;
        $this->isAveOpen = false;
    }

    public function closeAveNoModal($id)
    {
        $this->openmodalval=$id;
        $this->avepricereadonly=$id;
        $this->isAveOpen = false;
    }
}
