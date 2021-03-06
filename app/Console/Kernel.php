<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use File;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $cronLog = storage_path('logs/cron.log');
       if (!File::exists($cronLog)) {
           File::put($cronLog, '');
       }

        /*ejecutar todos los dias a las 12:01 de media noche*/
        $schedule->command('command:update_estado_curso')
        ->dailyAt('00:01')
        ->timezone('America/Bogota')
        ->withoutOverlapping()
        ->appendOutputTo($cronLog);
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
