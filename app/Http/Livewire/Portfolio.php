<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;
use App\Models\Transaction;
use Livewire\WithPagination;

class Portfolio extends Component
{
    use WithPagination;

    public $search;
    public $sortColumn;
    public $sortDirection;

    public function render()
    {
        $data=Stock::join('transaction','transaction.s_id','stock.id')->get();
        return view('livewire.portfolio',['currentholding'=>$this->fetchData(),'tradesdata'=>$data]);
    }

    public function sort($column)
    {
        $this->sortDirection = $column === $this->sortColumn ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortColumn = $column;

        return $this->fetchData();
    }

    public function fetchData()
    {
        return Stock::
            when($this->search, function ($q) {
                $q->where('company_name', 'like', "$this->search%");
            })->
            when($this->sortColumn && $this->sortDirection, function ($q) {
                $q->orderBy($this->sortColumn, $this->sortDirection);
            })
            ->paginate();
    }
}
