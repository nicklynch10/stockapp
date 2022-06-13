<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AnalyzeCompare extends Component
{
    public $ticker = 'TSLA';
    public function render()
    {
        return view('livewire.analyze-compare');
    }
}
