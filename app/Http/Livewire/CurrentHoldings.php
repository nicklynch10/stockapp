<?php

namespace App\Http\Livewire;

use App\Jobs\CurrentHoldingsUpdate;
use App\Models\ViewStockUpdate;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Stock;
use App\Models\Account;
use App\Models\Transaction;
use Livewire\Component;

class CurrentHoldings extends Component
{
    public $search;
    public $sortColumn = "current_total_value";
    public $sortDirection = "desc";
    public $currstock;
    public $current;
    public $buy;
    public $sharebuy;
    public $sell;
    public $sharesell;
    public $current_total_value;
    public $total_cost;
    public $gain;
    public $diff;
    public $dchange;
    public $pchange;
    public $result;
    public $accountId;
    public $accountFilter;
    protected $listeners = ['currentHolings' => 'render'];
    protected $queryString = [
        'search' => ['except' => ''],
        'accountFilter' => ['except' => ''],
    ];
    public bool $loadData = false;


    public function render()
    {
        $this->currstock=Stock::where('user_id', Auth::user()->id)->get();

        foreach ($this->currstock as $st) {
            $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($st->date_of_purchase))->format('Y-m-d')), date_create(date('Y-m-d')));
            $result = Stock::find($st->id);
            $result->update([
                'total_long_term_gains'=>$diff->format("%a")>366 ? "Long / " .$diff->days." day held" : "Short / ".$diff->days." day held",
            ]);
        }

        $this->account = Account::where('user_id', Auth::user()->id)->get();

        return view('livewire.current-holdings',['currentholding' => $this->fetchData()]);
    }


    public function sort($column)
    {
        if($column != 0){
            $this->sortDirection = $column === $this->sortColumn ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
            $this->sortColumn = $column;
        }
        else{
            $this->sortColumn = 'stock_ticker';
        }
        return $this->fetchData();
    }

    public function fetchData()
    {
        return ViewStockUpdate::select('view_stock_update.*','stock.account_id','stock.issuetype','stock.security_name','stock.company_name','stock.share_number','stock.ave_cost','stock.current_share_price','stock.total_long_term_gains','stock.ticker_logo')
            ->join('stock','stock.id','view_stock_update.stock_id')
            ->where('stock.user_id', Auth::user()->id)
            ->when($this->search, function ($q) {
                $q->where('company_name', 'like', "$this->search%");
            })
            ->when($this->accountFilter, function ($q) {
                $q->where('account_id', $this->accountFilter);
            })
            ->when($this->sortColumn && $this->sortDirection, function ($q) {
                $q->orderBy($this->sortColumn, $this->sortDirection);
            })
            ->get();
    }

    public function company($id)
    {
        $this->emit('company', $id);
    }
}
