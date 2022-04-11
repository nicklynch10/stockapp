<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\User;
use App\Notifications\Currentportfoliochange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $getstock = User::join('stock','stock.user_id','users.id')->get();
        foreach ($getstock as $stock) {
            $token = env('IEX_CLOUD_KEY', null);
            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
            $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
            $price = $current_price->json();
            $record = Stock::find($stock->id);
            if($stock->current_share_price != $price['latestPrice'])
            {
                $record->update([
                    'current_share_price' => $price['latestPrice'],
                ]);


                $totalpchange = (($price['latestPrice']/$stock->ave_cost)-1)*100;
                if ($totalpchange < 1 || $totalpchange > 1 || $totalpchange < 5 || $totalpchange > 5 || $totalpchange < 10) {
                    $details = [
                        'body' => strtoupper($stock->stock_ticker).' Total % Change Is '.($totalpchange < 0 ? "(".abs(round($totalpchange, 2))."%)" : abs(round($totalpchange, 2))."%"),
                    ];
                }

                $user = User::where('id',$stock->user_id)->get();
                foreach ($user as $u) {
                    $u->notify(new Currentportfoliochange($details));
                    sleep(2);
                }
            }
        }
    }
}
