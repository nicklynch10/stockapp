<?php

namespace App\Console\Commands;

use App\Jobs\UpdateStockPriceNotification;
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
        dispatch(new UpdateStockPriceNotification());
    }
}
