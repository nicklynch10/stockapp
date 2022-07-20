<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Account;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompletedSection extends Component
{
    public $stockData;
    public $stock;
    public $confirmSection = false;

    public function render()
    {
        $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock',1)->where('stock.user_id', Auth::user()->id)->with('account','viewupdatestock')
//                ->where('viewupdatestock.pchange','>',3)->where('viewupdatestock.total_gain_loss','<',0)
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange','<','-3')
                    ->where('total_gain_loss','<',0);
            })
            ->paginate(10);
        $links = $stockData->links();
        $this->stockData = collect($stockData->items());

        return view('livewire.optimize.completed-section',['links'=>$links]);
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
