<?php

namespace App\Http\Livewire;

use App\Jobs\CurrentHoldingsUpdate;
use App\Models\ViewStockUpdate;
use Carbon\Carbon;
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
    public $currstock;
    public $current;
    public $buy;
    public $sharebuy;
    public $sell;
    public $sharesell;
    public $current_total_value;
    public $total_cost;
    public $gain;
    public $diff;
    public $dchange;
    public $pchange;
    public $result;


    public function company($id)
    {
        $this->emit('company', $id);
    }

    public function render()
    {
        $this->currstock=Stock::where('user_id', Auth::user()->id)->get();
        foreach ($this->currstock as $st) {
                $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($st->date_of_purchase))->format('Y-m-d')), date_create(date('Y-m-d')));
                $result = Stock::find($st->id);
                $result->update([
                    'total_long_term_gains'=>$diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
                ]);
            }
        $this->data=ViewStockUpdate::join('stock','stock.id','view_stock_update.stock_ids')->where('stock.user_id',Auth::user()->id)->get();
        return view('livewire.current-holdings', ['currentholding'=>$this->fetchData()]);
    }

    public function sort($column)
    {
        $this->sortDirection = $column === $this->sortColumn ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortColumn = $column;
        return $this->fetchData();
    }

    public function fetchData()
    {
        return Stock::where('user_id', Auth::user()->id)->
        when($this->search, function ($q) {
            $q->where('company_name', 'like', "$this->search%");
        })->
        when($this->sortColumn && $this->sortDirection, function ($q) {
            $q->orderBy($this->sortColumn, $this->sortDirection);
        })->paginate();
    }
}
