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
    public $stock_id = 0;
    public $note;

    public $issellShareOpen = 0;

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


    public $openmodalval=0;
    public $avepricereadonly=0;
    protected $listeners=['edit' => 'edit','stockData' => 'render'];
//'sharesell' => 'sharesellopen'

    public function render()
    {
        $this->stocks=Stock::where('user_id', Auth::user()->id)->orderBy('date_of_purchase', 'DESC')->orderBy('created_at', 'DESC')->get();
        $this->gettransaction = Transaction::all();
        $this->account = Account::where('user_id', Auth::user()->id)->get();
        $this->emit('historicaldata');
        return view('livewire.stock');
    }

    public function create()
    {
        $this->emit('create');
    }

    public function editStock($id)
    {
        $this->emit('editStock', $id);
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

    public function deletestock($id)
    {
        $this->emit('stockDelete',$id);
    }

}
