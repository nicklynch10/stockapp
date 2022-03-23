<?php

namespace App\Http\Controllers;
use Cron\CronExpression;
use DateTimeZone;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;

use Illuminate\Support\Carbon;
use Lorisleiva\CronTranslator\CronTranslator;

class DeveloperController extends Controller
{

    //NOTE: do not remove $kernel variable, otherwise it will break.
    public function cron(Kernel $kernel, Schedule $schedule)
    {
        $events = array_map(function ($event) {
            return [
                'command' => $this->getCommand($event->command),
                'frequency' => CronTranslator::translate($event->expression),
                'description' => $event->description,
                'next_execute_at' => (new CronExpression($event->expression))
                    ->getNextRunDate(Carbon::now()->setTimezone($event->timezone))
                    ->setTimezone(new DateTimeZone($event->timezone ?? config('app.timezone')))
                    ->format('Y-m-d H:i:s'),
            ];
        }, $schedule->events());

        return view('developer.crons', ['events' => $events]);
    }

    public function getCommand($command)
    {
        return trim(last(explode("'artisan'", $command)));
    }
}
