<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->command('ark:maintain:delegates')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:avatars')
            ->everyThirtyMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:delegates')
            ->everyFiveMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:supply')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:blocks')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:voters-count')
            ->everyFifteenMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('ark:poll:voters')
            ->everyFifteenMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('ark:cache:stablity')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule
            ->command('ark:cache:calculator')
            ->everyFiveMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('ark:cache:forging')
            ->everyFiveMinutes()
            ->withoutOverlapping();

        $schedule
            ->command('backup:clean')
            ->daily();

        $schedule
            ->command('backup:run')
            ->daily();

        $schedule
            ->command('backup:monitor')
            ->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
