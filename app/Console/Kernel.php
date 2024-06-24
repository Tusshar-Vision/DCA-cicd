<?php

namespace App\Console;

use App\Console\Commands\GenerateSitemap;
use App\Jobs\DisableExpiredAnnouncements;
use App\Jobs\EnableAutomatedAnnouncements;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->job(new DisableExpiredAnnouncements)->everySixHours();
         $schedule->job(new EnableAutomatedAnnouncements)->everySixHours();
         $schedule->command('sitemap:generate')->daily();
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
