<?php

namespace App\Console;

use App\Console\Commands\CreateHash;
use App\Console\Commands\DeliverHash;
use App\Console\Commands\FetchHash;
use App\Console\Commands\GenerateHash;
use App\Console\Commands\ReturnHash;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CreateHash::class,
        FetchHash::class,
        ReturnHash::class,
        GenerateHash::class,
        DeliverHash::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
