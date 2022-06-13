<?php

namespace App\Console;

use App\Console\Commands\LogClear;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\updatestockprice;

class Kernel extends ConsoleKernel
{
    // public $timezone='America/New_York';
    protected $commands=[
        updatestockprice::class,
        LogClear::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:stockprice')->daily()->timezone('America/New_York');
        $schedule->command('log:clear')->everyMinute()->timezone('America/New_York');
        $schedule->command('stock:updatelatestprice')->dailyAt('13:00')->timezone('America/New_York');
        $schedule->command('send:test-email')->daily()->timezone('America/New_York');
        $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping()->timezone('America/New_York');
        $schedule->command('send:test-email')->daily()->timezone('America/New_York');
        $schedule->command('refresh:stocks')->hourly()->timezone('America/New_York');
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
