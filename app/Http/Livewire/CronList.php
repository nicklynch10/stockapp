<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class CronList extends Component
{
    public $crons = [];

    public function render()
    {
        return view('livewire.cron-list');
    }

    public function executeCron($command)
    {
            Artisan::call($command);
//        dispatch(function () use ($command) {
//            Artisan::call($command);
//        });
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>'Cron execution started!'
        ]);
    }
}
