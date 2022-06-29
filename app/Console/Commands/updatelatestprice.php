<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class updatelatestprice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:updatelatestprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stock latest price';

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
            if ($price == null) {
                $current_price = Http::get($endpoint . 'stable/crypto/' . $stock->stock_ticker . '/quote?token=' . $token);
                $price = $current_price->json();
            }
            if ($price !== null) {
                $record = Stock::find($stock->id);
                if ($stock->current_share_price != $price['latestPrice']) {
                    $record->update([
                        'current_share_price' => $price['latestPrice'],
                        'company_name' => $price['companyName'],
                        'currentpriceupdate_date' => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }
    }
}
