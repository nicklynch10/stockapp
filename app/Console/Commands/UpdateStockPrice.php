<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Commands;
use Illuminate\Support\Facades\Http;
use App\Notifications\Currentportfoliochange;

class UpdateStockPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stockprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Stock Price';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getstock=Stock::all();
        foreach($getstock as $stock)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
            $price = $current_price->json();
            $record = Stock::find($stock->id);
            $update=$record->update([
                'current_share_price'=>$price['latestPrice'],
            ]);

            $totalpchange= ($price['latestPrice']/$stock->ave_cost)-1;
            if($totalpchange<1 || $totalpchange>1 || $totalpchange<5 || $totalpchange>5 || $totalpchange<10)
            {
                $details=[
                    'body' => strtoupper($stock->stock_ticker).' Total % Change Is '.($totalpchange<0?"(".abs(round($totalpchange,2))."%)":abs(round($totalpchange,2))."%"),
                ];
            }
            $user=User::all();
            foreach($user as $u)
            {
                $u->notify(new Currentportfoliochange($details));
            }
        }
    }
}
