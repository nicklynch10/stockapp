<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrency;
use App\Models\MutualFunds;
use App\Models\StockTicker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public $token;
    public $endpoint;

    public function __construct()
    {
        $this->token = env('IEX_CLOUD_KEY', null);
        $this->endpoint = env('IEX_CLOUD_ENDPOINT', null);
    }

    public function addTicker()
    {
        $symbol = Http::get($this->endpoint . 'stable/ref-data/symbols?token=' . $this->token);
        $company = $symbol->json();
        foreach ($company as $com) {
            StockTicker::Create([
                'ticker'=>$com['symbol'],
                'ticker_company'=>$com['name'],
            ]);
        }
        return redirect('portfolio');
    }

    public function addMutualFunds()
    {
        $symbol = Http::get($this->endpoint . 'stable/ref-data/mutual-funds/symbols?token=' . $this->token);
        $funds = $symbol->json();
        foreach ($funds as $com) {
            MutualFunds::Create([
                'symbol'=>$com['symbol'],
                'name'=>$com['name'],
            ]);
        }
        return redirect('portfolio');
    }

    public function addCryptoCurrency()
    {
        $symbol = Http::get($this->endpoint . 'stable/ref-data/crypto/symbols?token=' . $this->token);
        $funds = $symbol->json();
        foreach ($funds as $com) {
            CryptoCurrency::Create([
                'crypto_symbol'=>$com['symbol'],
                'crypto_name'=>$com['name'],
            ]);
        }
        return redirect('portfolio');
    }
}
