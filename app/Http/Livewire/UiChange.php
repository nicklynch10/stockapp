<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class UiChange extends Component
{
    public function render()
    {
            $this->stock=Stock::where('share_number','!=',0)->get();
        return view('livewire.ui-change');
    }
}
