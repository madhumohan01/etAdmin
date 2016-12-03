<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $job_position = 'developer';
            // echo $keyword->tech_name;
            Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position)
            {
                $message->from('madhum@etangerine.org', 'Madhu Mohan');
                // $message->to('xnjz2-5888762258@serv.craigslist.org');
                $message->to('maddy.10m@gmail.com');
                $message->subject('Your craigslist ad for a '.strtolower($job_position));
            });
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
