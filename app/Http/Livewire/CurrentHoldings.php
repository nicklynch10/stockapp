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
        $currstock=Stock::where('user_id',Auth::user()->id)->get();
        foreach($currstock as $st)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $current = Http::get($endpoint . 'stable/stock/'.$st->stock_ticker.'/quote?token=' . $token);
            $price_current = $current->json();
            $transaction=Transaction::all();
            $sharebuy=0;
            $buy=0;
            $sell=0;
            $sharesell=0;
            foreach($transaction as $tra)
            {
                if($tra->stock_id==$st->id)
                {
                    if($tra->type==0)
                    {
                        $buy=$tra->share_price;
                        $sharebuy+=$tra->stock;
                    }
                    elseif ($tra->type==1)
                    {
                        $sell=$tra->share_price;
                        $sharesell+=$tra->stock;
                    }
                }
            }
            $current_total_value=($price_current['latestPrice']*$st->share_number);
            $total_cost=($st->ave_cost*$st->share_number);
            $gain=$current_total_value-$total_cost;
            $diff=date_diff(date_create(\Carbon\Carbon::createFromTimestamp(strtotime($st->date_of_purchase))->format('Y-m-d')),date_create(date('Y-m-d')));
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
                'total_long_term_gains'=>$diff->format("%a")>366?"Long / ". \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($st->date_of_purchase)) ." Days held":"Short / ". \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($st->date_of_purchase)) ." Days held",
            ]);
        }
        return view('livewire.current-holdings',['currentholding'=>$this->fetchData(),'transaction'=>Transaction::all()]);
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
