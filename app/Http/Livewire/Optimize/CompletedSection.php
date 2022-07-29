<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Account;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompletedSection extends Component
{
    public $stockData;
    public $stock;
    public $confirmSection = false;
    public $adminUsers;
    public $hasMoreCompletedPages;
    public $completedPage = 1;
    public $completedPerPage = 2;
    public $loadingCompletedPages = false;

    public function mount()
    {
        $this->stockData = new Collection();
        $this->loadSection();
    }

    public function render()
    {
        return view('livewire.optimize.completed-section');
    }

    public function loadSection($viaSearch = false)
    {
        $this->loadingCompletedPages = true;

        $section =  Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock', 1)->where('ave_cost', '>', 'current_share_price')->where('user_id', Auth::user()->id)
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange', '<', '-3')
                    ->where('total_gain_loss', '<', 0);
            })
            ->with('account', 'viewupdatestock')
            ->skip(($this->completedPage - 1) * $this->completedPerPage)
            ->take($this->completedPerPage)
            ->get();


        $this->stockData->push(...$section);

        $this->hasMoreCompletedPages = (bool)count($section);

        $this->loadingCompletedPages = false;
    }

    public function loadMoreCompleted()
    {
        if ($this->hasMoreCompletedPages !== null && !$this->hasMoreCompletedPages) {
            return;
        }

        $this->completedPage++;

        $this->loadSection();
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
