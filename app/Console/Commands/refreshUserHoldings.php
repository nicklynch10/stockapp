<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\refreshUserHoldingsJob;
use App\Models\User;

class refreshUserHoldings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:user_holdings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refreshes user holdings in the background for check-for-comps page';

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
        $stocks = User::join('stock', 'stock.user_id', 'users.id')->get()->pluck("stock_ticker")->unique();
        foreach ($stocks as $s) {
            $job = (new refreshUserHoldingsJob($s))->delay(now()->addSeconds(1));
            dispatch($job);
        }
    }
}
