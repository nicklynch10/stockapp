<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IgnoreSection extends Component
{
    public $stockData;
    public $stock;
    public $confirmSection = false;
    public $hasMorePagesIgnore;
    public $ignorePage = 1;
    public $ignorePerPage = 8;
    public $loadingIgnorePages = false;

    public function mount()
    {
        $this->stockData = new Collection();
        $this->loadSection();
    }

    public function render()
    {
//        $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock',2)->where('ave_cost', '>', 'current_share_price')->where('stock.user_id', Auth::user()->id)->with('account','viewupdatestock')
//            ->whereHas('viewupdatestock', function ($query) {
//                $query->where('pchange','<','-3')
//                    ->where('total_gain_loss','<',0);
//            })
//            ->paginate(10, ['*'], 'ignore');
//        $links = $stockData->links();
//        $this->stockData = collect($stockData->items());

        return view('livewire.optimize.ignore-section');
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

    public function loadSection()
    {
        $this->loadingIgnorePages = true;

        $section =  Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock', 2)->where('ave_cost', '>', 'current_share_price')->where('user_id', Auth::user()->id)
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange', '<', '-3')
                    ->where('total_gain_loss', '<', 0);
            })
            ->with('account', 'viewupdatestock')
            ->skip(($this->ignorePage - 1) * $this->ignorePerPage)
            ->take($this->ignorePerPage)
            ->get();



        $this->stockData->push(...$section);

        $this->hasMorePagesIgnore = (bool)count($section);

        $this->loadingIgnorePages = false;
    }

    public function loadMoreIgnore()
    {
        if ($this->hasMorePagesIgnore !== null && !$this->hasMorePagesIgnore) {
            return;
        }

        $this->ignorePage++;

        $this->loadSection();
    }

}
