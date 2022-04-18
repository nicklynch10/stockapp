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
    public $deleteid=0;
    public $openmodalval=0;
    public $avepricereadonly=0;
    protected $listeners=['AveModal'=>'openAveModal','edit' => 'edit','stockData' => 'render','stockDelete' => 'stockDelete'];


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
    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function stockDelete($id)
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
