<?php

namespace App\Http\Controllers;

use App\Models\MutualFunds;
use App\Models\StockTicker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function addTicker()
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $symbol = Http::get($endpoint . 'stable/ref-data/symbols?token=' . $token);
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
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $symbol = Http::get($endpoint . 'stable/ref-data/mutual-funds/symbols?token=' . $token);
        $funds = $symbol->json();
        foreach ($funds as $com) {
            MutualFunds::Create([
                'symbol'=>$com['symbol'],
                'name'=>$com['name'],
            ]);
        }
        return redirect('portfolio');
    }
}
