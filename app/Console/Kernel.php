<?php

namespace App\Console;

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
        $schedule->command('mtv:importa-convocatorias')
                    ->dailyAt('04:00')
                    ->environments(['production'])
                    ->appendOutputTo( storage_path('logs/mtv') . '/cronjobs.log');

        $schedule->command('mtv:importa-prebases')
            ->dailyAt('08:00')
            ->environments(['production'])
            ->appendOutputTo( storage_path('logs/mtv') . '/cronjobs.log');

        $schedule->command('mtv:importa-directorio-cdmx')
                    ->quarterly()
                    ->environments(['production'])
                    ->appendOutputTo( storage_path('logs/mtv') . '/cronjobs.log');

        $schedule->command('mtv:importa-requisiciones')
                    ->quarterly()
                    ->environments(['production'])
                    ->appendOutputTo( storage_path('logs/mtv') . '/cronjobs.log');
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
