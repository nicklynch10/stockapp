<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StockShareSell extends Component
{
    public $issellShareOpen = 0;
    protected $listeners = ['sharesell' => 'sharesellopen'];

    public function render()
    {
        return view('livewire.stock-share-sell');
    }
    public function sharesellopen()
    {
        $this->issellShareOpen = true;
    }

    public function closeSellShareModal()
    {
        $this->issellShareOpen = false;
    }
}
