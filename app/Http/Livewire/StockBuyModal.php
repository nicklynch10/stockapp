<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StockBuyModal extends Component
{
    public $isbuyOpen = 0;
    public $stock;
    public $current_price;
    public $price;
    public $current_share_price;
    public $stock_id;
    public $stock_ticker;
    public $company_name;
    public $security_name;
    public $description;
    public $sector;
    public $market_cap;
    public $average_cost;
    public $share_number;
    public $share_price;
    public $openmodalval;
    public $date_of_purchase;
    protected $listeners = ['buy' => 'buyModal'];

    public function render()
    {
        $this->emit('historicaldata');
        return view('livewire.stock-buy-modal');
    }
    public function buyModal($id)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $stock = Stock::findOrFail($id);
        $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);

        $price = $current_price->json();
        $this->current_share_price = $price ? $price['latestPrice'] : $stock->current_share_price;
        $this->stock_id = $id;
        $this->stock_ticker = $stock->stock_ticker;
        $this->company_name = $stock->company_name;
        $this->security_name = $stock->security_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->market_cap = $stock->market_cap;
        $this->average_cost = '';
        $this->share_number = '';
        $this->share_price = '';
        $this->openmodalval=1;
        $this->date_of_purchase = Carbon::now()->format('Y-m-d');
        $this->openBuyModal();
    }

    public function addbuy()
    {
        $this->validate([
            'average_cost' => 'required|regex:/^[1-9]+/|not_in:0',
            'share_number' => 'required|regex:/^[1-9]+/|not_in:0',
        ]);
        $current_stock=Stock::where('id', $this->stock_id)->first();
        $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($this->date_of_purchase))->format('Y-m-d')), date_create(date('Y-m-d')));
        $buyInsertid=Stock::Create([
            'user_id'=>Auth::user()->id,
            'stock_ticker' => $this->stock_ticker,
            'company_name' => $this->company_name,
            'security_name' => $this->security_name,
            'description' => $this->description,
            'sector' => $this->sector,
            'market_cap' => $this->market_cap,
            'current_share_price' => $this->current_share_price,
            'issuetype' => $current_stock->issuetype,
            'tags' => $current_stock->tags,
            'ave_cost' => $this->average_cost,
            'share_number' => $this->share_number,
            'date_of_purchase' => $this->date_of_purchase,
            'account_id'=>$current_stock->account_id,
            'dchange'=>($this->current_share_price-$this->average_cost)*$this->share_number,
            'pchange'=>($this->current_share_price/$this->average_cost)-1,
            'current_total_value'=>($this->current_share_price*$this->share_number),
            'total_cost'=>($this->average_cost*$this->share_number),
            'total_gain_loss'=>0,
            'total_long_term_gains'=>$diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
        ]);
        $lastBuyInsertedID = $buyInsertid->id;
        Transaction::Create([
            'stock_id' => $lastBuyInsertedID,
            'type'=>0,
            'ticker_name'=>$this->stock_ticker,
            'stock'=>$this->share_number,
            'share_price'=>$this->average_cost,
            'user_id'=>Auth::user()->id,
            'date_of_transaction'=>$this->date_of_purchase,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type'=>'success',
            'message'=>'Stock Ticker : <b>'.$this->stock_ticker. '</b><br/> Total Buy : <b>'. $this->share_number.'</b> Shares'
        ]);
        $this->buyModal($this->stock_id);
        $this->emit('stockData');
        $this->closeBuyModal();
    }

    public function openBuyModal()
    {
        $this->isbuyOpen = true;
    }

    public function closeBuyModal()
    {
        $this->isbuyOpen = false;
        $this->emit('closeCompany');
    }
}
