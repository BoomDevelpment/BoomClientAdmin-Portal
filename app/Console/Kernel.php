<?php

namespace App\Console;

use App\Console\Commands\ScrapersBCV;
use App\Console\Commands\ConsolidateZelle;
use App\Console\Commands\ProcessConsolidateZelle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('scraper:bcv')->hourly();
        // $schedule->command('zelle:consolidate')->cron('*/30 7-21 * * *');
        $schedule->command('zelle:process')->cron('*/45 7-21 * * *');
        $schedule->command('zelle:consolidate')->everyMinute();
        // $schedule->command('zelle:process')->everyFiveMinutes();

        // ->everyMinute();
        // ->everyTwoMinutes();
        // ->everyThreeMinutes();
        // ->everyFourMinutes();
        // ->everyFiveMinutes();
        // ->everyTenMinutes();
        // ->everyFifteenMinutes();
        // ->everyThirtyMinutes();
        // ->hourly();
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
