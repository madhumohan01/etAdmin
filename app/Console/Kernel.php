<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
            Log::info('JOB|TESTEMAIL|Started');
            Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position)
            {
                $message->from('madhum@etangerine.org', 'Madhu Mohan');
                $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
                // $message->to('maddy.10m@gmail.com');
                $message->subject('Hi Your craigslist ad for a '.strtolower($job_position));
            });
            Log::info('JOB|TESTEMAIL|Ended');
        })->cron('0 * * * * *');

        $schedule->call(function () {
            $post = \App\Models\APosts::where('status',"=",'Got_Email')->where('ignore_flg',"!=",1)->orderBy('id')->get()->first();
            if (count($post)) {
                Log::info('JOB|SENDEMAIL|Started for POST:'.$post->post_id);
                $keyword = $post->keyword()->first();
                $job_position = strtolower($keyword->tech_text_1);
                $email_id = $post->email_addr;
                // echo $keyword->tech_name;
                Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $email_id)
                {
                    $message->from('madhum@etangerine.org', 'Madhu Mohan');
                    // $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
                    $message->to($email_id)->cc('madhu.mohan@etangerine.org');
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
                $post->status = "SENT_MAIL";
                $post->save();
                Log::info('JOB|SENDEMAIL|Ended for POST:'.$post->post_id);
            }
        })->cron('10,20,30,40,50 * * * * *');
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
