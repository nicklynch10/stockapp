<?php

namespace App\Http\Controllers;

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
            StockTicker::updateOrCreate(['ticker'=>$com['symbol']], [
                'ticker'=>$com['symbol'],
                'ticker_company'=>$com['name'],
            ]);
        }
        return redirect('portfolio');
    }
}
