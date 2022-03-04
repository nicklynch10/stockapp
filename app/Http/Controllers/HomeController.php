<?php

namespace App\Http\Controllers;

use App\Models\StockTicker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function addTicker()
    {
        $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
        $endpoint = 'https://cloud.iexapis.com/';
        $symbol = Http::get($endpoint . 'stable/ref-data/symbols?token=' . $token);
        $company = $symbol->json();
        foreach($company as $com)
        {
            StockTicker::Create([
               'ticker'=>$com['symbol'],
                'ticker_company'=>$com['name'],
            ]);
        }
    }
}
