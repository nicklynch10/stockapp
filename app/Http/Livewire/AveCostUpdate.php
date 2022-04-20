<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AveCostUpdate extends Component
{
    public $openmodalval=0;
    public $isAveOpen=false;
    protected $listeners = ['AveModal'=>'openAveModal',];

    public function render()
    {
        return view('livewire.ave-cost-update');
    }

    public function openAveModal()
    {
        if ($this->openmodalval==0) {
            $this->isAveOpen = true;
        }
    }

    public function closeAveModal($id)
    {
        $this->openmodalval=$id;
        $this->isAveOpen = false;
    }

    public function closeAveNoModal($id)
    {
        $this->openmodalval=$id;
        $this->avepricereadonly=$id;
        $this->emit('changeaveprice',$id);
        $this->isAveOpen = false;
    }
}
