<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class StockDeleteModal extends Component
{
    public $deleteid = 0;
    public $isdeleteOpen = 0;
    public $deletestock = false;
    protected $listeners = ['stockDelete' => 'stockDelete'];

    public function render()
    {
        return view('livewire.stock-delete-modal');
    }

    public function delete($id)
    {
        Stock::find($id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type'=>'error',
            'message'=>'Stock Deleted Successfully.'
        ]);
        $this->closedeletestock();
        $this->emit('closeModal');
        $this->emit('closeCompany');
        $this->emit('currentHolings');
    }

    public function stockDelete($id)
    {
        $this->deleteid=$id;
        $this->deletestock=true;
    }

    public function closedeletestock()
    {
        $this->deletestock=false;
    }
}
