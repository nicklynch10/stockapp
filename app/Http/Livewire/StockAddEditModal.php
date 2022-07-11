<?php

namespace App\Http\Livewire;


use App\Models\Account;
use App\Models\CryptoCurrency;
use App\Models\MutualFunds;
use App\Models\Stock;
use App\Models\StockTicker;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Null_;

class StockAddEditModal extends Component
{
    protected $listeners=['create' => 'create','editStock' => 'editStockModal','closeModal' => 'closeModal','changeaveprice' => 'changeaveprice'];
    public $isOpen = 0;
    public $currentStep = 1;
    public $stock_id = 0;
    public $stock_ticker;
    public $company_name;
    public $description;
    public $security_name;
    public $sector;
    public $market_cap;
    public $current_share_price;
    public $average_cost;
    public $issuetype;
    public $tags;
    public $share_number;
    public $tickerorcompany;
    public $openmodalval;
    public $note;
    public $date_of_purchase;
    public $account_type;
    public $companyname;
    public $avepricereadonly;
    public $company;
    public $tickerLogo;
    public $logo;
    public $logo_url;
    public $data;
    public $type;


    public function render()
    {
        if($this->tickerorcompany == null)
        {
            $this->company_name = '';
            $this->stock_ticker = '';
            $this->description = '';
            $this->sector = '';
            $this->issuetype = '';
            $this->security_name = '';
            $this->current_share_price = '';
            $this->market_cap = '';
            $this->average_cost = '';
            $this->share_number = '';
            $this->tickerLogo='';
        }
        if ($this->tickerorcompany != null && $this->average_cost == null && $this->stock_id == null) {
            $this->stockTicker = StockTicker::where('ticker', $this->tickerorcompany)->orWhere('ticker_company', 'like', '%' . $this->tickerorcompany . '%')->first();
            if(!$this->stockTicker){
                $this->mutualFund = MutualFunds::where('symbol', $this->tickerorcompany)->orWhere('name', 'like', '%' . $this->tickerorcompany . '%')->first();
                if(!$this->mutualFund){
                    $this->crypto = CryptoCurrency::where('crypto_symbol',$this->tickerorcompany)->orWhere('crypto_name', 'like', '%' . $this->tickerorcompany . '%')->first();
                }
            }
            if(!isset($this->crypto))
            {
                $this->data = $this->stockTicker ? $this->stockTicker['ticker'] : ($this->mutualFund ? $this->mutualFund['symbol'] : $this->tickerorcompany);
                $stock = new Stock;
                $companyData = $stock->stockCompanyData($this->data);
                if($companyData != null)
                {
                    $this->company_name = $companyData['companyName'];
                    $this->stock_ticker = $companyData['symbol'];
                    $this->description = $companyData['description'];
                    $this->sector = $companyData['sector'];
                    $this->issuetype = $companyData['issueType'];
                    $this->tags = $companyData['tags'];
                    $this->security_name = $companyData['securityName'];
                    $this->type = $this->stockTicker ? 0 : 1;

                    $priceData = $stock->stockPriceData($this->data);
                    $this->current_share_price = $priceData['latestPrice'];
                    $this->market_cap = $priceData['marketCap'];

                    $logoData = $stock->stockLogoData($this->data);
                    $this->tickerLogo = $logoData;
                }
                else
                {
                    $this->company_name = '';
                    $this->stock_ticker = 'No Company Found';
                    $this->description = '';
                    $this->sector = '';
                    $this->issuetype = '';
                    $this->security_name = '';
                    $this->current_share_price = '';
                    $this->market_cap = '';
                    $this->average_cost = '';
                    $this->share_number = '';
                    $this->tickerLogo='';
                    $this->type = '';
                }
            }
            elseif(isset($this->crypto))
            {
                $crypto = new Stock;
                $cryptoData = $crypto->cryptoPriceData($this->crypto['crypto_symbol']);
                $this->current_share_price = $cryptoData['latestPrice'];
                $this->company_name = $this->crypto['crypto_name'];
                $this->stock_ticker = $this->crypto['crypto_symbol'];
                $this->type = 2;
            }
        }
        $this->emit('stockData');
        $this->account = Account::where('user_id', Auth::user()->id)->get();
        return view('livewire.stock-add-edit-modal');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'average_cost' => 'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
            'share_number' => 'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
            'date_of_purchase' => 'required',
            'company_name' => 'required',
            'account_type' => 'required',
        ],['company_name.required' => 'No Company Found Please Enter Valid Company Name','account_type.required' => 'Please select account' ]);

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

    private function resetInputFields()
    {
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
        $this->openmodalval = 1;
        $this->currentStep = 1;
        $this->note = '';
        $this->tickerLogo = '';
        $this->type = '';
        $this->date_of_purchase = Carbon::now()->format('Y-m-d');
        $default = Account::where(['user_id'=>Auth::user()->id,'set_default'=>1])->first();
        $this->account_type = $default ? $default->id : '';
    }

    public function store()
    {
        $this->validate([
            'stock_ticker' => 'required',
            'average_cost' => 'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
            'share_number' => 'required|numeric|min:0|regex:/^[0-9]+/|not_in:0',
            'date_of_purchase' => 'required',
            'account_type' => 'required',
        ]);
        $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($this->date_of_purchase))->format('Y-m-d')), date_create(date('Y-m-d')));
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
            'type' => $this->type,
            'ave_cost' => $this->average_cost,
            'share_number' => $this->share_number,
            'date_of_purchase' => $this->date_of_purchase,
            'note' => $this->note,
            'account_id' => $this->account_type,
            'dchange' => $this->current_share_price-$this->average_cost,
            'pchange' => (($this->current_share_price/$this->average_cost)-1)*100,
            'current_total_value' => ($this->current_share_price*$this->share_number),
            'total_cost' => ($this->average_cost*$this->share_number),
            'total_gain_loss' => ($this->current_share_price*$this->share_number)-($this->average_cost*$this->share_number),
            'total_long_term_gains' => $diff->format("%a")>366 ? "Long / " .$diff->format("%d")." days held" : "Short / ".$diff->format("%d")." days held",
            'ticker_logo' => $this->tickerLogo,
        ]);
        $lastInsertedID = $insertid->id;

        Transaction::updateOrCreate(['stock_id' => $this->stock_id], [
            'stock_id' => $lastInsertedID,
            'type' => 0,
            'ticker_name' => $this->stock_ticker,
            'stock' => $this->share_number,
            'share_price' => $this->average_cost,
            'user_id' => Auth::user()->id,
            'date_of_transaction' => $this->date_of_purchase,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type'=>'success',
            'message'=>$this->stock_id ? 'Stock Updated Successfully.' : 'Stock Ticker : <b>'.$this->stock_ticker .'</b><br/> Total Buy : <b>' .$this->share_number.'</b> Shares'
        ]);
        if ($this->stock_id==null) {
            $this->openModal();
        } else {
            $this->closeModal();
            $this->emit('AveClose',1);
        }
        $this->emit('stockData');
        $this->resetInputFields();
    }

    public function editStockModal($id)
    {
        $stock = Stock::findOrFail($id);
        $this->stock_id = $id;
        $this->tickerorcompany=$stock->stock_ticker;
        $this->stock_ticker = $stock->stock_ticker;
        $this->companyname = $stock->stock_ticker;
        $this->company_name = $stock->company_name;
        $this->security_name = $stock->security_name;
        $this->description = $stock->description;
        $this->sector = $stock->sector;
        $this->current_share_price = $stock->current_share_price;
        $this->issuetype = $stock->issuetype;
        $this->tags = $stock->tags;
        $this->openmodalval = 0;
        $this->avepricereadonly = 0;
        $this->currentStep = 1;
        $this->type = $stock->type;
        $this->market_cap = $stock->market_cap;
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->share_price = '';
        $this->date_of_purchase = Carbon::parse($stock->date_of_purchase)->format('Y-m-d');
        $this->note = $stock->note;
        $this->account_type = $stock->account_id;
        $this->tickerLogo = $stock->ticker_logo;
        $this->emit('AveClose',0);
        $this->openModal();
    }

    public function openModal()
    {
        $this->resetValidation('average_cost');
        $this->resetValidation('share_number');
        $this->resetValidation('date_of_purchase');
        $this->resetValidation('company_name');
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function deletestock($id)
    {
        $this->emit('stockDelete',$id);
    }

    public function changeaveprice($id)
    {
        $this->openmodalval = 0;
    }
}
