<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
    // Every 30 minutes during the night
    $schedule->command('call:exchange-rate-controller')
             ->timezone('Europe/London') // replace with your timezone
             ->everyThirtyMinutes()
             ->between('0:00', '8:00');

    // Every 10 minutes during the day on weekdays
    $schedule->command('call:exchange-rate-controller')
             ->timezone('Europe/London') // replace with your timezone
             ->everyTenMinutes()
             ->between('8:00', '24:00')
             ->weekdays();

    // Every 90 minutes during weekends
    $schedule->command('call:exchange-rate-controller')
             ->timezone('Europe/London') // replace with your timezone
             ->hourly()
             ->weekends();
             
    $schedule->command('app:store-daily-average-rates')
              ->dailyAt('19:59');
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
