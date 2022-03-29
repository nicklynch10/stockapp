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
    public $user_id,$stocks, $company_name, $description, $sector, $market_cap, $current_share_price, $average_cost, $share_number, $date_of_purchase, $stock_id, $note;
    public $isOpen = 0;
    public $isdeleteOpen = 0;
    public $currentStep = 1;

    public $isAveOpen=false;
    public $ticker = Null;
    public $stock_ticker = Null;
    public $current_price, $price, $account, $account_type, $tags, $issuetype,$security_name;
    public $symbol, $tickerdata;
    public $lastInsertedID, $insertid;
    public $type, $stock, $share_price, $share_sold, $date_of_transaction,$alltags;
    public $diff,$tickerorcompany;
    public $current_stock, $final_stock, $record, $result, $gettransaction,$companyname,$buyInsertid,$lastBuyInsertedID;
    public $deletestock = false;

    public $openmodalval=0,$avepricereadonly=0;
    protected $listeners=['AveModal'=>'openAveModal','edit' => 'edit'];


    public function render()
    {
        if($this->tickerorcompany!=Null)
        {
            $this->companyname = StockTicker::where('ticker', $this->tickerorcompany)
                ->first();
            if(!$this->companyname)
            {
                $this->companyname = StockTicker::where('ticker_company', 'like', '%' . $this->tickerorcompany . '%')
                    ->first();
            }
            $this->company_name=$this->companyname?$this->companyname['ticker_company']:'';
            $this->stock_ticker=$this->companyname?$this->companyname['ticker']:'';

            if($this->companyname && $this->companyname['ticker'])
            {
                $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
                $endpoint = 'https://cloud.iexapis.com/';
                $symbol = Http::get($endpoint . 'stable/stock/'.$this->companyname['ticker'].'/company?token=' . $token);
                $company = $symbol->json();
                $this->description = $company ? $company['description'] : '';
                $this->sector = $company ? $company['sector'] : '';
                if(isset($company['issueType']))
                {
                    if($company['issueType']=='et')
                    {
                        $this->issuetype="ETF";
                    }
                    elseif ($company['issueType']=='ad')
                    {
                        $this->issuetype="ADR";
                    }
                    elseif ($company['issueType']=='cs')
                    {
                        $this->issuetype="Common Stock";
                    }
                    else
                    {
                        $this->issuetype=$company['issueType'];
                    }
                }
                $this->tags=$company?json_encode($company['tags']):'';
                $this->security_name=$company?$company['securityName']:'';
                $current_price = Http::get($endpoint . 'stable/stock/' . $this->companyname['ticker'] . '/quote?token=' . $token);
                $price = $current_price->json();
                $this->current_share_price = $price ? $price['latestPrice'] : '';
                $this->market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
            }
        }
        $this->stocks=Stock::where('user_id',Auth::user()->id)->orderBy('date_of_purchase','DESC')->orderBy('created_at','DESC')->get();
        $this->gettransaction = Transaction::all();
        $this->account = Account::where('user_id', Auth::user()->id)->get();
        $this->emit('historicaldata');
        return view('livewire.stock');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'average_cost' => 'required',
            'share_number' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }
    public function back($step)
    {
        $this->currentStep = $step;
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
        $this->security_name = '';
        $this->sector = '';
        $this->market_cap = '';
        $this->current_share_price = '';
        $this->average_cost = '';
        $this->issuetype = '';
        $this->share_number = '';
        $this->tickerorcompany = '';
        $this->openmodalval=1;
        $this->currentStep=1;
        $this->note='';
        $this->date_of_purchase=Carbon::now()->format('Y-m-d');
        $default=Account::where(['user_id'=>Auth::user()->id,'set_default'=>1])->first();
        $this->account_type=$default?$default->id:'';
    }

    public function store()
    {
        $this->validate([
            'stock_ticker' => 'required',
            'average_cost' => 'required',
            'share_number' => 'required',
        ]);

        $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($this->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
        $insertid=Stock::updateOrCreate(['id' => $this->stock_id], [
            'user_id'=>Auth::user()->id,
            'stock_ticker' => $this->stock_ticker,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'sector' => $this->sector,
            'security_name' => $this->security_name,
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
            'total_long_term_gains'=>$diff->format("%a")>366?"Long / " .$diff->format("%d")." Days held" :"Short / ".$diff->format("%d")." Days held",
        ]);
        $lastInsertedID = $insertid->id;

        Transaction::updateOrCreate(['stock_id' => $this->stock_id],[
            'stock_id' => $lastInsertedID,
            'type'=>0,
            'ticker_name'=>$this->stock_ticker,
            'stock'=>$this->share_number,
            'share_price'=>$this->average_cost,
            'user_id'=>Auth::user()->id,
            'date_of_transaction'=>$this->date_of_purchase,
        ]);
//        $this->emit('historicaldata');
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

        $symbol = Http::get($endpoint . 'stable/stock/'.$stock->stock_ticker.'/company?token=' . $token);
        $company = $symbol->json();

        $this->stock_id = $id;
        $this->tickerorcompany=$stock->stock_ticker;
        $this->stock_ticker = $stock->stock_ticker;
        $this->companyname = $stock->stock_ticker;
        $this->company_name = $company['companyName'];
        $this->security_name = $company['securityName'];
        $this->description = $company['description'];
        $this->sector = $company['sector'];
        $this->current_share_price = $price ? $price['latestPrice'] : '';
        if(isset($company['issueType']))
        {
            if($company['issueType']=='et')
            {
                $this->issuetype="ETF";
            }
            elseif ($company['issueType']=='et')
            {
                $this->issuetype="ADR";
            }
            elseif ($company['issueType']=='cs')
            {
                $this->issuetype="Common Stock";
            }
            else
            {
                $this->issuetype=$company['issueType'];
            }
        }
        else
        {
            $this->issuetype='';
        }
        $this->tags = json_encode($company['tags']);
        $this->openmodalval=0;
        $this->avepricereadonly=0;
        $this->currentStep=1;
        $this->market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
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
//        $this->emit('historicaldata');
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
        $this->emit('sell',$id);
    }

    public function buy($id) // Add Buy Stock Functions
    {
        $this->emit('buy',$id);
    }

    public function company($stockticker) // Company Detail Function
    {
        $this->emit('company',$stockticker);
    }

    public function openAveModal()
    {
        if($this->openmodalval==0)
        {
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
