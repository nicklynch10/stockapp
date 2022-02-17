<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class CurrentHoldings extends Component
{
    public $search;
    public $sortColumn;
    public $sortDirection;

    public function render()
    {
        return view('livewire.current-holdings',['currentholding'=>$this->fetchData(),]);
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
