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
        dispatch(new \App\Jobs\CurrentHoldings($currstock));
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
