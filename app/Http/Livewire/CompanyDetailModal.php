<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Carbon\Carbon;
use Livewire\Component;

class CompanyDetailModal extends Component
{
    public $isCompanyOpen = 0;
    public $stock_id,$stock_ticker,$company_name,$description,$sector,$market_cap,$alltags,$current_share_price,$average_cost,$share_number,$issuetype,$share_price,$date_of_purchase;
    protected $listeners = ['company' => 'companyDetail'];

    public function render()
    {
        $this->emit('historicaldata');
        return view('livewire.company-detail-modal');
    }

    // Company Detail
    public function companyDetail($stockticker)
    {
        $tickerdata = Stock::findOrFail($stockticker);
        $this->stock_id = $tickerdata->id;
        $this->stock_ticker = $tickerdata->stock_ticker;
        $this->company_name = $tickerdata->security_name;
        $this->description = $tickerdata->description;
        $this->sector = $tickerdata->sector;
        $this->market_cap = $tickerdata->market_cap;
        $this->alltags = json_decode($tickerdata->tags);
        $this->current_share_price = $tickerdata->current_share_price;
        $this->average_cost = $tickerdata->ave_cost;
        $this->share_number = $tickerdata->share_number;
        $this->issuetype = $tickerdata->issuetype;
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
    // End Company Detail


    public function sell($id)
    {
        $this->emit('sell',$id);
    }

    public function buy($id)
    {
        $this->emit('buy',$id);
    }

    public function edit($id)
    {
        $this->emit('edit',$id);
    }
}
