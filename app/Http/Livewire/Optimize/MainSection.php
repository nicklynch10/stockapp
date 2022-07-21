<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Account;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MainSection extends Component
{
    public $stockData;
    public $sortBy;
    public $accounts;
    public $stock;
    public $confirmIgnoreSection = false;
    public $confirmCompleteSection = false;
    public $confirmSection = false;

    public function render()
    {
        $account=['Roth IRA','Traditional IRA','401K','Sep IRA','Health Savings Account','529 Account','Other Non-Taxable Account'];
        $this->accounts = Account::where('user_id', Auth::user()->id)->whereNotIn('account_name', $account)->get();
        if ($this->sortBy) {
            $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock',0)->where('current_share_price','<','ave_cost')->where('user_id', Auth::user()->id)->where('account_id', $this->sortBy)
                ->whereHas('viewupdatestock', function ($query) {
                    $query->where('pchange','<','-3')
                        ->where('total_gain_loss','<',0);
                })
                ->with('account','viewupdatestock')->paginate(10);

        } else {
            $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock',0)->where('current_share_price','<','ave_cost')->where('stock.user_id', Auth::user()->id)
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange','<','-3')
                    ->where('total_gain_loss','<',0);
            })
            ->with('account','viewupdatestock')
            ->paginate(10);
        }
        $links = $stockData->links();
        $this->stockData = collect($stockData->items());

        return view('livewire.optimize.main-section',['links'=>$links]);
    }

    public function confirmIgnoreSection($stockId)
    {
        $this->stock = Stock::find($stockId);
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
        $this->stock = Stock::find($stockId);
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
