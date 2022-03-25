<?php

namespace App\Jobs;

use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CurrentHoldings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $currstock;
    public function __construct($currstock)
    {
        $this->currstock=$currstock;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->currstock as $st)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $current = Http::get($endpoint . 'stable/stock/'.$st->stock_ticker.'/quote?token=' . $token);
            $price_current = $current->json();
            $current_total_value=($price_current['latestPrice']*$st->share_number);
            $total_cost=($st->ave_cost*$st->share_number);
            $gain=$current_total_value-$total_cost;
            $dchange=$price_current['latestPrice']-$st->ave_cost;
            $pchange=(($price_current['latestPrice']/$st->ave_cost)-1)*100;
            $result=Stock::find($st->id);
            $result->update([
                'current_share_price'=>$price_current['latestPrice'],
                'dchange'=>$dchange,
                'pchange'=>$pchange,
                'current_total_value'=>$current_total_value,
                'total_cost'=>$total_cost,
                'total_gain_loss'=>$gain,
            ]);
        }
    }
}
