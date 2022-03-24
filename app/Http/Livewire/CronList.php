<?php

namespace App\Http\Livewire;

use Artisan;
use Livewire\Component;

class CronList extends Component
{
    public $crons = [];

    public function render()
    {
        $this->data="test";
        return view('livewire.cron-list');
    }

    public function executeCron($command)
    {
        $command='update:stockprice';
        dispatch(function () use ($command) {
            Artisan::call($command);
        });

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>'Cron execution started!'
        ]);
    }
}
