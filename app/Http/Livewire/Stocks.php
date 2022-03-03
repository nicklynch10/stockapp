<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
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
    public $stocks,$company_name,$description, $sector,$market_cap,$current_share_price,$average_cost,$share_number,$date_of_purchase,$stock_id,$note;
    public $isOpen = 0;
    public $issellOpen=0;
    public $isbuyOpen=0;
    public $isdeleteOpen=0;
    public $isCompanyOpen=0;
    public $ticker=Null;
    public $stock_ticker=Null;
    public $current_price,$price,$account,$account_type,$tags,$issuetype;
    public $symbol,$tickerdata;
    public $lastInsertedID,$insertid;
    public $type,$stock,$share_price,$share_sold,$date_of_transaction;
    public $diff;
    public $current_stock,$final_stock,$record,$result,$gettransaction;
    public $deletestock=false;

    public function render()
    {
        if($this->stock_ticker!=Null && $this->average_cost==Null)
        {
            $this->getdata($this->stock_ticker);
        }
        $this->stocks = Stock::orderBy('updated_at','DESC')->get();
        $this->gettransaction = Transaction::all();
        $this->account= Account::where('user_id',Auth::user()->id)->get();
        $this->emit('historicaldata');
        return view('livewire.stock');
    }

    public function getdata($ticker=Null)
    {
        if($ticker!=Null)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $symbol = Http::get($endpoint . 'stable/stock/' . $ticker . '/company?token=' . $token);
            $company = $symbol->json();
            $this->company_name = $company ? $company['companyName'] : '';
            $this->description = $company ? $company['description'] : '';
            $this->sector = $company ? $company['sector'] : '';
            $this->issuetype=$company?$company['issueType']:'';
            $this->tags=$company?json_encode($company['tags']):'';

            $marketcap = Http::get($endpoint . 'stable/stock/' . $ticker . '/stats?token=' . $token);
            $market = $marketcap->json();
            $this->market_cap = $market ? round(($market['marketcap']/1000000), 2) : '';

            $current_price = Http::get($endpoint . 'stable/stock/' . $ticker . '/quote?token=' . $token);
            $price = $current_price->json();
            $this->current_share_price = $price ? $price['latestPrice'] : '';
        }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->stock_id = '';
        $this->stock_ticker = '';
        $this->company_name = '';
        $this->description = '';
        $this->sector = '';
        $this->market_cap = '';
        $this->current_share_price = '';
        $this->average_cost = '';
        $this->issuetype = '';
        $this->share_number = '';
        $this->note='';
        $this->date_of_purchase=Carbon::now()->format('Y-m-d');
        $default=Account::where(['user_id'=>Auth::user()->id,'set_default'=>1])->first();
        $this->account_type=$default->id;
    }

    public function store()
    {
        $this->validate([
            'stock_ticker' => 'required',
            'average_cost' => 'required',
            'share_number' => 'required',
        ]);

        $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($this->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
        $insertid=Stock::updateOrCreate(['id' => $this->stock_id], [
            'stock_ticker' => $this->stock_ticker,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'sector' => $this->sector,
            'market_cap' => $this->market_cap,
            'current_share_price' => $this->current_share_price,
            'issuetype' => $this->issuetype,
            'tags' => $this->tags,
            'ave_cost' => $this->average_cost,
            'share_number' => $this->share_number,
            'date_of_purchase' => $this->date_of_purchase,
            'note'=>$this->note,
            'account_id'=>$this->account_type,
            'dchange'=>($this->current_share_price-$this->average_cost)*$this->share_number,
            'pchange'=>($this->current_share_price/$this->average_cost)-1,
            'current_total_value'=>($this->current_share_price*$this->share_number),
            'total_cost'=>($this->average_cost*$this->share_number),
            'total_gain_loss'=>0,
            'total_long_term_gains'=>$diff->format("%a")>366?"Long":"Short",
        ]);
        $lastInsertedID = $insertid->id;

        if($this->stock_id==Null)
        {
            Transaction::Create([
                'stock_id' => $lastInsertedID,
                'type'=>0,
                'stock'=>$this->share_number,
                'share_price'=>$this->average_cost,
                'date_of_transaction'=>$this->date_of_purchase,
            ]);
        }
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>$this->stock_id ? 'Stock Updated Successfully.' : 'Stock Ticker : <b>'.$this->stock_ticker .'</b><br/> Total Buy : <b>' .$this->share_number.'</b> Shares'
        ]);
        if($this->stock_id==Null)
        {
            $this->openModal();
        }
        else
        {
            $this->closeModal();
        }
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
        $endpoint = 'https://cloud.iexapis.com/';
        $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
        $price=$current_price->json();
        $this->stock_id = $id;
        $this->stock_ticker = $stock->stock_ticker;
        $this->company_name = $stock->company_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->market_cap = $stock->market_cap;
        $this->current_share_price = $price ? $price['latestPrice'] : '';
        $this->issuetype = $stock->issuetype;
        $this->tags = $stock->tags;
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->share_price = '';
        $this->date_of_purchase =Carbon::parse($stock->date_of_purchase)->format('Y-m-d');
        $this->note = $stock->note;
        $this->account_type=$stock->account_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Stock::find($id)->delete();
        $this->dispatchBrowserEvent('alert',[
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

//   Sell Stock Functions
    public function sell($id)
    {
        $stock = Stock::findOrFail($id);
        $this->stock_id = $id;
        $this->stock_ticker = $stock->stock_ticker;
        $this->company_name = $stock->company_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->market_cap = $stock->market_cap;
        $this->current_share_price = $stock->current_share_price;
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->share_price = '';
        $this->share_sold = '';
        $this->date_of_purchase = Carbon::parse($stock->date_of_purchase)->format('Y-m-d');
        $this->openSellModal();
    }

    public function addsell()
    {
        $this->validate([
           'share_price'=>'required',
            'share_sold'=>'required',
        ]);
        Transaction::create([
            'stock_id'=>$this->stock_id,
            'type'=>1,
            'stock'=>$this->share_sold,
            'share_price'=>$this->share_price,
            'date_of_transaction'=>$this->date_of_purchase,
        ]);

        if($this->stock_id)
        {
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
            $this->closeSellModal();
        }
    }

    public function openSellModal()
    {
        $this->issellOpen = true;
    }

    public function closeSellModal()
    {
        $this->issellOpen = false;
    }
    //  End Sell Stock Functions

    //  Add Buy Stock Functions
    public function buy($id)
    {
        $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
        $endpoint = 'https://cloud.iexapis.com/';
        $stock = Stock::findOrFail($id);
        $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
        $price = $current_price->json();
        $this->current_share_price = $price ? $price['latestPrice'] : '';
        $this->stock_id = $id;
        $this->stock_ticker = $stock->stock_ticker;
        $this->company_name = $stock->company_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->market_cap = $stock->market_cap;
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->share_price = '';
        $this->date_of_purchase = Carbon::parse($stock->date_of_purchase)->format('Y-m-d');
        $this->openBuyModal();
    }

    public function addbuy()
    {
        $this->validate([
            'share_number'=>'required',
        ]);

        Transaction::Create([
            'stock_id' => $this->stock_id,
            'type'=>0,
            'stock'=>$this->share_number,
            'share_price'=>$this->average_cost,
            'date_of_transaction'=>$this->date_of_purchase,
        ]);

        if($this->stock_id)
        {
            $current_stock=Stock::select('share_number')->where('id',$this->stock_id)->first();
            $final_stock=$current_stock->share_number+$this->share_number;
            $record = Stock::find($this->stock_id);
            $record->update([
                'share_number'=>$final_stock,
            ]);
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Stock Ticker : <b>'.$this->stock_ticker. '</b><br/> Total Buy : <b>'. $this->share_number.'</b> Shares'
            ]);
            $this->buy($this->stock_id);
        }
        $this->closeBuyModal();
    }

    public function openBuyModal()
    {
        $this->isbuyOpen = true;
    }

    public function closeBuyModal()
    {
        $this->isbuyOpen = false;
    }
    //  End Buy Stock Functions

    // Company Detail Function

    public function company($stockticker)
    {
        $tickerdata=Stock::findOrFail($stockticker);
        $this->stock_id=$tickerdata->id;
        $this->stock_ticker = $tickerdata->stock_ticker;
        $this->company_name = $tickerdata->company_name;
        $this->description = $tickerdata->description;
        $this->sector = $tickerdata->sector;
        $this->market_cap = $tickerdata->market_cap;
        $this->tags = $tickerdata->tags;
        $this->current_share_price = $tickerdata->current_share_price;
        $this->average_cost = $tickerdata->ave_cost;
        $this->share_number = $tickerdata->share_number;
        $this->share_price = '';
        $this->date_of_purchase = Carbon::parse($tickerdata->date_of_purchase)->format('Y-m-d');
        $this->openCompanyModal();
    }



    public function openCompanyModal()
    {
        $this->isCompanyOpen = true;
    }

    public function closeCompanyModal()
    {
        $this->isCompanyOpen = false;
    }

    // End Company detail Function



}
