<?php

namespace App\Console;

use App\Console\Commands\StockPriceUpdate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\updatestockprice;

class Kernel extends ConsoleKernel
{
   // public $timezone='America/New_York';
    protected $commands=[
        updatestockprice::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
         $schedule->command('update:stockprice')->twiceDaily(1, 13)->timezone('America/New_York');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
