<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\RefreshStocks;

class RefreshStocksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refreshes random stocks in the background to reduce load times';

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
        $job = (new RefreshStocks())->delay(now()->addSeconds(1));
        dispatch($job);
    }
}
