<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Stock;
use Livewire\Component;

class CompleteIgnoreStock extends Component
{
    public $completeIgnore;
    public $status;
    public $stock;
    public $confirmSection = false;

    public function mount($completeIgnore)
    {
        $this->completeIgnore = $completeIgnore;
    }

    public function render()
    {
        return view('livewire.optimize.complete-ignore-stock');
    }
    public function confirmSection($stockId)
    {
        $this->stock = Stock::find($stockId);
        if ($this->stock) {
            $this->confirmSection = true;
        } else {
            $this->reset('stock');
        }
    }

    public function cancelSection()
    {
        $this->confirmSection = false;
    }

    public function section()
    {
        if ($this->confirmSection) {
            $this->stock->update([
                'ignore_stock' => 0,
            ]);
            $this->reset(['stock', 'confirmSection']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'success',
                'message' => 'Section Succesfullay',
            ]);
            $this->redirectRoute('optimize');
        }
    }

}
