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
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
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
        if ($this->tickerorcompany != null && $this->average_cost == null) {
            $this->companyname = StockTicker::where('ticker', $this->tickerorcompany)->orWhere('ticker_company', 'like', '%' . $this->tickerorcompany . '%')->first();
            if (!$this->companyname) {
                $this->companyname = MutualFunds::where('symbol', $this->tickerorcompany)->orWhere('name', 'like', '%' . $this->tickerorcompany . '%')->first();
                if(!$this->companyname)
                {
                    $this->cryptoData = CryptoCurrency::where('crypto_symbol',$this->tickerorcompany)->orWhere('crypto_name', 'like', '%' . $this->tickerorcompany . '%')->first();
                }
            }
            if(isset($this->companyname)) {
                if ($this->companyname && $this->companyname['ticker'] || $this->companyname['symbol']) {
                    if($this->companyname['ticker'])
                    {
                        $this->type = 0;
                    }
                    elseif ($this->companyname['symbol'])
                    {
                        $this->type = 1;
                    }
                    $this->data = $this->companyname['ticker'] ? $this->companyname['ticker'] : $this->companyname['symbol'];
                    $symbol = Http::get($endpoint . 'stable/stock/'.$this->data.'/company?token=' . $token);
                    $company = $symbol->json();
                    $this->company_name = $company ? $company['companyName'] : $this->companyname['ticker_company'];
                    $this->stock_ticker = $this->companyname ? $company['symbol'] : $this->companyname['ticker'];
                    $this->description = $company ? $company['description'] : null;
                    $this->sector = $company ? $company['sector'] : null;
                    $this->issuetype = $company ? $company['issueType'] : null;
                    $this->tags = $company ? json_encode($company['tags']) : null;
                    $this->security_name = $company ? $company['securityName'] : null;
                    $current_price = Http::get($endpoint . 'stable/stock/' . $this->data . '/quote?token=' . $token);
                    $price = $current_price->json();
                    $this->current_share_price = $price ? $price['latestPrice'] : '';
                    $this->market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
                    $logo = Http::get($endpoint . 'stable/stock/' . $this->data . '/logo?token=' . $token);
                    $logo_url = $logo->json();
                    $this->tickerLogo = $logo_url ? $logo_url['url'] : '';
                }
            }
            elseif(isset($this->cryptoData)){
                $current_price = Http::get($endpoint . 'stable/crypto/' . $this->cryptoData['crypto_symbol'] . '/quote?token=' . $token);
                $price = $current_price->json();
                $this->current_share_price = $price ? $price['latestPrice'] : '';
                $this->company_name = $this->cryptoData['crypto_name'];
                $this->stock_ticker = $this->cryptoData['crypto_symbol'];
                $this->type = 2;
            }
            else {
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
            'company_name' => 'required'
        ],['company_name.required' => 'No Company Found Please Enter Valid Company Name']);

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
            'total_long_term_gains' => $diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
            'ticker_logo' => $this->tickerLogo,
        ]);
        $lastInsertedID = $insertid->id;

        Transaction::updateOrCreate(['stock_id' => $this->stock_id], [
            'stock_id' => $lastInsertedID,
            'type'=>0,
            'ticker_name'=>$this->stock_ticker,
            'stock'=>$this->share_number,
            'share_price'=>$this->average_cost,
            'user_id'=>Auth::user()->id,
            'date_of_transaction'=>$this->date_of_purchase,
        ]);
//        $this->emit('historicaldata');
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
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
        $price=$current_price->json();
        if(!$price)
        {
            $current_price = Http::get($endpoint . 'stable/crypto/' . $stock->stock_ticker . '/quote?token=' . $token);
            $cryprice=$current_price->json();
        }
        $symbol = Http::get($endpoint . 'stable/stock/'.$stock->stock_ticker.'/company?token=' . $token);
        $company = $symbol->json();
        $this->stock_id = $id;
        $this->tickerorcompany=$stock->stock_ticker;
        $this->stock_ticker = $stock->stock_ticker;
        $this->companyname = $stock->stock_ticker;
        $this->company_name = $company ? $company['companyName'] : ($cryprice['companyName'] ? $cryprice['companyName'] : $stock->company_name);
        $this->security_name = $company ? $company['securityName'] : $stock->security_name;
        $this->description = $company ? $company['description'] : $stock->description;
        $this->sector = $company ? $company['sector'] : $stock->sector;
        $this->current_share_price = $price ? $price['latestPrice'] : ($cryprice ? $cryprice['latestPrice'] : $stock->current_share_price);
        $this->issuetype=$stock->issuetype;
        $this->tags = json_encode($company ? $company['tags'] : $stock->tags);
        $this->openmodalval=0;
        $this->avepricereadonly=0;
        $this->currentStep=1;
        $this->market_cap = $price ? round(($price['marketCap']/1000000), 0) : ($stock->market_cap ? round(($stock->market_cap/1000000), 0) : 0);
        $this->average_cost = $stock->ave_cost;
        $this->share_number = $stock->share_number;
        $this->share_price = '';
        $this->date_of_purchase =Carbon::parse($stock->date_of_purchase)->format('Y-m-d');
        $this->note = $stock->note;
        $this->account_type = $stock->account_id;
        $logo = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/logo?token=' . $token);
        $logo_url = $logo->json();
        $this->tickerLogo = $logo_url ? $logo_url['url'] : $stock->ticker_logo;
//        $this->tickerLogo = '';
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
//        $this->emit();
//        $this->avepricereadonly = $id;
    }
}
