<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Designchange extends Component
{
    public function render()
    {
        $this->stocks=Stock::where('user_id', Auth::user()->id)->orderBy('date_of_purchase', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('livewire.designchange');
    }
}
