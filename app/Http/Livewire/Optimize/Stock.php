<?php

namespace App\Http\Livewire\Optimize;

use Livewire\Component;

class Stock extends Component
{
    public $toploss;
    public $stock;
    public $confirmIgnoreSection = false;
    public $confirmCompleteSection = false;
    public $confirmSection = false;

    public function mount($toploss)
    {
        $this->toploss=$toploss;
//        dd($toploss);
    }

    public function render()
    {
        return view('livewire.optimize.stock');
    }
    public function confirmIgnoreSection($stockId)
    {
        $this->stock = \App\Models\Stock::find($stockId);
        if ($this->stock) {
            $this->confirmIgnoreSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelIgnoreSection()
    {
        $this->confirmIgnoreSection = false;
    }

    public function ignoreSection()
    {
        if ($this->confirmIgnoreSection) {
            $this->stock->update([
                'ignore_stock' => 2,
            ]);
            $this->reset(['stock', 'confirmIgnoreSection']);

            $this->dispatchBrowserEvent('notify', [
                'style' => 'danger',
                'message' => 'Ignore Section',
            ]);

            $this->redirectRoute('optimize');
        }
    }

    public function confirmCompleteSection($stockId)
    {
        $this->stock = \App\Models\Stock::find($stockId);
        if ($this->stock) {
            $this->confirmCompleteSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelCompleteSection()
    {
        $this->confirmCompleteSection = false;
    }

    public function completeSection()
    {
        if ($this->confirmCompleteSection) {
            $this->stock->update([
                'ignore_stock' => 1,
            ]);
            $this->reset(['stock', 'confirmCompleteSection']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'success',
                'message' => 'Complete Section',
            ]);
        }
        $this->redirectRoute('optimize');
    }
}
