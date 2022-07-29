<?php

namespace App\Http\Livewire\Optimize;

use App\Models\Account;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
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
    public $comparable_data = [];
    public $adminUsers;
    public $hasMorePages;
    public $page = 1;
    public $perPage = 8;
    public $loadingPages = false;
    protected $queryString = [
        'sortBy'
    ];

    public function mount()
    {
        $this->stockData = new Collection();
        $this->loadSection();
    }

    public function render()
    {
        $account=['Roth IRA','Traditional IRA','401K','Sep IRA','Health Savings Account','529 Account','Other Non-Taxable Account'];
        $this->accounts = Account::where('user_id', Auth::user()->id)->whereNotIn('account_name', $account)->get();
//        if ($this->sortBy) {
//            $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock', 0)->where('ave_cost', '>', 'current_share_price')->where('user_id', Auth::user()->id)->where('account_id', $this->sortBy)
//                ->whereHas('viewupdatestock', function ($query) {
//                    $query->where('pchange', '<', '-3')
//                        ->where('total_gain_loss', '<', 0);
//                })
//                ->with('account', 'viewupdatestock')->paginate(10);

//        }
// else {
//            $stockData = Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock', 0)->where('ave_cost', '>', 'current_share_price')->where('stock.user_id', Auth::user()->id)
//            ->whereHas('viewupdatestock', function ($query) {
//                $query->where('pchange', '<', '-3')
//                    ->where('total_gain_loss', '<', 0);
//            })
//            ->with('account', 'viewupdatestock')
//            ->paginate(2);
//        }
//        $links = $stockData->links();
////        dd($links);
//        $this->stockData = collect($stockData->items());
//        $this->loadloadSection();
//        return view('livewire.optimize.main-section', ['links'=>$links]);
        return view('livewire.optimize.main-section');
    }


    public function loadSection($viaSearch = false)
    {
        $this->loadingPages = true;

        $section =  Stock::where('current_share_price', '<>', 0)->where('ave_cost', '<>', 0)->where('ignore_stock', 0)->where('ave_cost', '>', 'current_share_price')->where('user_id', Auth::user()->id)
            ->whereHas('viewupdatestock', function ($query) {
                $query->where('pchange', '<', '-3')
                    ->where('total_gain_loss', '<', 0);
            })
            ->when($this->sortBy, function ($q) {
               $q->where('account_id', $this->sortBy);
            })
            ->with('account', 'viewupdatestock')
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
//        dd($section);



        $this->stockData->push(...$section);

        $this->hasMorePages = (bool)count($section);

        $this->loadingPages = false;
    }

    public function loadMore()
    {
        if ($this->hasMorePages !== null && !$this->hasMorePages) {
            return;
        }

        $this->page++;

        $this->loadSection();
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

    public function init()
    {
        //dd("loaded");
    }

    public function updateSortBy(){
            $this->stockData = new Collection();

        $this->loadSection(true);
    }
}
