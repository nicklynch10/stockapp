<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CurrentHoldingsUpdate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $currentHold = null;


    public function __construct($currentHold)
    {
        $this->cureentholding=$currentHold;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->cureentholding as $st) {
            $token = env('IEX_CLOUD_KEY', null);
            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
            $current = Http::get($endpoint . 'stable/stock/'.$st->stock_ticker.'/quote?token=' . $token);
            $price_current = $current->json();
            if ($price_current!=null) {
                if ($st->current_share_price != $price_current['latestPrice']) {
                    $current_total_value = $price_current ? $price_current['latestPrice'] : $st->current_share_price*$st->share_number;
                    $total_cost = ($st->ave_cost*$st->share_number);
                    $gain = $current_total_value-$total_cost;
                    $dchange = $price_current ? $price_current['latestPrice'] : $st->current_share_price-$st->ave_cost;
                    $pchange = (($price_current ? $price_current['latestPrice'] : $st->current_share_price/$st->ave_cost)-1)*100;
                    $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($st->date_of_purchase))->format('Y-m-d')), date_create(date('Y-m-d')));
                    $result = Stock::find($st->id);
                    $result->update([
                        'current_share_price' => $price_current ? $price_current['latestPrice'] : $st->current_share_price,
                        'dchange' => $dchange,
                        'pchange' => $pchange,
                        'current_total_value' => $current_total_value,
                        'total_cost' => $total_cost,
                        'total_gain_loss' => $gain,
                        'total_long_term_gains'=>$diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
                    ]);
                }
            }
            break;
        }
    }
}
