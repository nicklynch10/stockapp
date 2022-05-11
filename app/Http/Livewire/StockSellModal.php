<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StockSellModal extends Component
{

    public $issellOpen = 0;
    public $issellShareOpen = 0;
    public $stock_id;
    public $stock_ticker;
    public $company_name;
    public $description;
    public $sector;
    public $market_cap;
    public $current_share_price;
    public $average_cost;
    public $share_number;
    public $issuetype;
    public $security_name;
    public $tags;
    public $share_price;
    public $share_sold;
    public $openmodalval;
    public $date_of_purchase;
    protected $listeners = ['sell' => 'sellModal'];

    public function render()
    {
        return view('livewire.stock-sell-modal');
    }

    public function sellModal($id)
    {
        $stock = Stock::findOrFail($id);
        $this->stock_id = $id;
        $this->stock_ticker = $stock->stock_ticker;
        $this->company_name = $stock->security_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->market_cap = $stock->market_cap;
        $this->current_share_price = $stock->current_share_price;
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->issuetype = $stock->issuetype;
        $this->security_name = $stock->security_name;
        $this->tags = $stock->tags;
        $this->share_price = '';
        $this->share_sold = '';
        $this->openmodalval=1;
        $this->date_of_purchase = Carbon::now()->format('Y-m-d');
        $this->openSellModal();
    }

    public function openSellModal()
    {
        $this->issellOpen = true;
    }

    public function closeSellModal()
    {
        $this->issellOpen = false;
        $this->emit('closeCompany');
    }

    public function addsell()
    {
        $this->validate([
            'share_price'=>'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
            'share_sold'=>'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
        ]);

        if($this->share_sold > $this->share_number){
            $this->emit('sharesell');
        }
        else{
            if($this->stock_id){
                Transaction::create([
                    'stock_id'=>$this->stock_id,
                    'type'=>1,
                    'ticker_name'=>$this->stock_ticker,
                    'stock'=>$this->share_sold,
                    'share_price'=>$this->share_price,
                    'user_id'=>Auth::user()->id,
                    'date_of_transaction'=>$this->date_of_purchase,
                ]);

                $current_stock=Stock::select('share_number')->where('id',$this->stock_id)->first();
                $final_stock=$current_stock->share_number-$this->share_sold;
                $record = Stock::find($this->stock_id);
                $record->update([
                    'share_number'=>$final_stock,
                ]);
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'success',
                    'message'=>'Stock Ticker : <b>'.$this->stock_ticker. '</b> <br/>Total Sold : <b>'. $this->share_sold.'</b> Shares'
                ]);
                $this->emit('stockData');
                $this->closeSellModal();
            }
        }
    }

}
