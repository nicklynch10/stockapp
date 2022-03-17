<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\updatestockprice;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */

    protected $commands = [
        Commands\UpdateStockPrice::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:stockprice')
            ->everyMinute();
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
