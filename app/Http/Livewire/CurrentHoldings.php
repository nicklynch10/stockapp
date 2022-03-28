<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Stock;
use App\Models\Transaction;
use Livewire\Component;

class CurrentHoldings extends Component
{
    public $search;
    public $sortColumn;
    public $sortDirection;
    public $currstock,$current,$buy,$sharebuy,$sell,$sharesell,$current_total_value,$total_cost,$gain,$diff,$dchange,$pchange,$result;

    public function render()
    {
        $this->currstock=Stock::where('user_id',Auth::user()->id)->get();
        foreach($this->currstock as $st)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $current = Http::get($endpoint . 'stable/stock/'.$st->stock_ticker.'/quote?token=' . $token);
            $price_current = $current->json();
            $current_total_value=($price_current['latestPrice']*$st->share_number);
            $total_cost=($st->ave_cost*$st->share_number);
            $gain=$current_total_value-$total_cost;
            $dchange=$price_current['latestPrice']-$st->ave_cost;
            $pchange=(($price_current['latestPrice']/$st->ave_cost)-1)*100;
            $result=Stock::find($st->id);
            $result->update([
                'current_share_price'=>$price_current['latestPrice'],
                'dchange'=>$dchange,
                'pchange'=>$pchange,
                'current_total_value'=>$current_total_value,
                'total_cost'=>$total_cost,
                'total_gain_loss'=>$gain,
            ]);
        }
//        dispatch(new \App\Jobs\CurrentHoldings($currstock));
        return view('livewire.current-holdings',['currentholding'=>$this->fetchData()]);
    }

    public function sort($column)
    {
        $this->sortDirection = $column === $this->sortColumn ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortColumn = $column;
        return $this->fetchData();
    }

    public function fetchData()
    {
        return Stock::where('user_id',Auth::user()->id)->
        when($this->search, function ($q) {
            $q->where('company_name', 'like', "$this->search%");
        })->
        when($this->sortColumn && $this->sortDirection, function ($q) {
            $q->orderBy($this->sortColumn, $this->sortDirection);
        })->paginate();
    }

}
