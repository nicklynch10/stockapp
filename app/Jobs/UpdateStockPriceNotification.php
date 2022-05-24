<?php

namespace App\Jobs;

use App\Models\Stock;
use App\Models\User;
use App\Notifications\Currentportfoliochange;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateStockPriceNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getstock = User::join('stock','stock.user_id','users.id')->get();
        foreach ($getstock as $stock) {
            $beforeTime = Carbon::now()->subHour(12);
            if($stock->currentpriceupdate_date > $beforeTime)
            {
                $currentPrice = $stock->current_share_price;
            }
            else
            {
                $token = env('IEX_CLOUD_KEY', null);
                $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
                $price = $current_price->json();
                if($price == null)
                {
                    $current_price = Http::get($endpoint . 'stable/crypto/' . $stock->stock_ticker . '/quote?token=' . $token);
                    $price = $current_price->json();
                }
                if($price!==null)
                {
                    $record = Stock::find($stock->id);
                    if($stock->current_share_price != $price['latestPrice']) {
                        $record->update([
                            'current_share_price' => $price['latestPrice'],
                            'currentpriceupdate_date' => Carbon::now()->toDateTimeString(),
                        ]);
                    }
                    $currentPrice = $price['latestPrice'];
                }
            }

//            $token = 'Tpk_c360aba9efce48ac94879b6d2b51d6bb';
//            $endpoint = 'https://sandbox.iexapis.com/';
//            $current_price = Http::get($endpoint . 'stable/stock/' . $stock->stock_ticker . '/quote?token=' . $token);
//            $price = $current_price->json();
//            if($price == null)
//            {
//                $current_price = Http::get($endpoint . 'stable/crypto/' . $stock->stock_ticker . '/quote?token=' . $token);
//                $price = $current_price->json();
//            }
//            if($price!==null)
//            {
//                $record = Stock::find($stock->id);
//                if($stock->current_share_price != $price['latestPrice'])
//                {
//                    $record->update([
//                        'current_share_price' => $price['latestPrice'],
//                    ]);
                    $totalpchange = (($currentPrice/$stock->ave_cost)-1)*100;
                    if(($totalpchange < 0 && $totalpchange >= -1) || ($totalpchange <= -4 && $totalpchange >= -6) || ($totalpchange <=-9 && $totalpchange >= -10))
                    {
                        $details = [
                            'body' => strtoupper($stock->stock_ticker).' Total % Change Is '.($totalpchange < 0 ? "(".abs(round($totalpchange, 2))."%)" : abs(round($totalpchange, 2))."%"),
                            'logo' => $stock->ticker_logo,
                        ];
                        if(isset($details))
                        {
                            $user = User::where('id',$stock->user_id)->get();
                            foreach ($user as $u) {
                                $u->notify(new Currentportfoliochange($details));
                            }
                        }
                    }
//                }
//            }
        }
    }
}
