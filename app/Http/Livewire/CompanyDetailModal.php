<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CompanyDetailModal extends Component
{
    public $isCompanyOpen = 0;
    public $stock_id;
    public $stock_ticker;
    public $company_name;
    public $description;
    public $sector;
    public $market_cap;
    public $alltags;
    public $current_share_price;
    public $average_cost;
    public $share_number;
    public $issuetype;
    public $share_price;
    public $date_of_purchase;
    public $tickerLogo;
    protected $listeners = ['company' => 'companyDetail','closeCompany' => 'closeCompanyModal'];


    public function sell($id)
    {
        $this->emit('sell',$id);
    }

    public function buy($id)
    {
        $this->emit('buy',$id);
    }

    public function editStock($id)
    {
        $this->emit('editStock',$id);
    }

    public function render()
    {
        $this->emit('historicaldata');
        return view('livewire.company-detail-modal');
    }

    // Company Detail
    public function companyDetail($stockticker)
    {
        if((int) $stockticker)
        {
            $tickerdata = Stock::findOrFail($stockticker);
            $this->stock_id = $tickerdata->id;
            $this->stock_ticker = $tickerdata->stock_ticker;
            $this->company_name = $tickerdata->company_name;
            $this->description = $tickerdata->description;
            $this->sector = $tickerdata->sector;
            $this->market_cap = $tickerdata->market_cap;
            $this->alltags = json_decode($tickerdata->tags);
            $this->current_share_price = $tickerdata->current_share_price;
            $this->average_cost = $tickerdata->ave_cost;
            $this->share_number = $tickerdata->share_number;
            $this->issuetype = $tickerdata->issuetype;
            $this->share_price = '';
            $this->tickerLogo = $tickerdata->ticker_logo;
            $this->date_of_purchase = Carbon::parse($tickerdata->date_of_purchase)->format('Y-m-d');
        }
        else
        {
            $token = env('IEX_CLOUD_KEY', null);
            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
            $symbol = Http::get($endpoint . 'stable/stock/'.$stockticker.'/company?token=' . $token);
            $company = $symbol->json();
            $this->stock_ticker = $company?$company['symbol']:'';
            $this->company_name = $company?$company['companyName']:'';
            $this->description = $company ? $company['description'] : null;
            $this->sector = $company ? $company['sector'] : null;
            $this->issuetype = $company ? $company['issueType'] : null;
            $this->alltags = $company ? $company['tags'] : null;
            $this->security_name = $company ? $company['securityName'] : null;
            $current_price = Http::get($endpoint . 'stable/stock/'.$stockticker.'/quote?token=' . $token);
            $price = $current_price->json();
            $this->current_share_price = $price ? $price['latestPrice'] : '';
            $this->market_cap = $price ? round(($price['marketCap']/1000), 2) : '';
            $logo = Http::get($endpoint . 'stable/stock/' . $stockticker . '/logo?token=' . $token);
            $logo_url = $logo->json();
            $this->tickerLogo = $logo_url ? $logo_url['url'] : '';
        }
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
    // End Company Detail



}
