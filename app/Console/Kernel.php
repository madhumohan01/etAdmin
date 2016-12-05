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
        \App\Console\Commands\SendEmails::class,
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
            if (env('GROUP_NUM', false) ===1 ) {
                Log::info('JOB|TESTEMAIL|Started');
                $job_position = 'developer';
                $from_email_id = env('MAIL_USERNAME', false); 
                Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $from_email_id)
                {
                    $message->from($from_email_id, 'Madhu Mohan');
                    $message->to('xnjz2-5888762258@serv.craigslist.org');
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
                Log::info('JOB|TESTEMAIL|Ended');
            }
        })->cron('2 08-18 * * * *');

        $schedule->call(function () {
            if (env('GROUP_NUM', false) === 2 ) {
                Log::info('JOB|TESTEMAIL|Started');
                $job_position = 'developer';
                $from_email_id = env('MAIL_USERNAME', false); 
                Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $from_email_id)
                {
                    $message->from($from_email_id, 'Madhu Mohan');
                    $message->to('xnjz2-5888762258@serv.craigslist.org');
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
                Log::info('JOB|TESTEMAIL|Ended');
            }
        })->cron('4 09-19 * * * *');

        $schedule->call(function () {
            if (env('GROUP_NUM', false) === 3 ) {
                Log::info('JOB|TESTEMAIL|Started');
                $job_position = 'developer';
                $from_email_id = env('MAIL_USERNAME', false); 
                Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $from_email_id)
                {
                    $message->from($from_email_id, 'Madhu Mohan');
                    $message->to('xnjz2-5888762258@serv.craigslist.org');
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
                Log::info('JOB|TESTEMAIL|Ended');
            }
        })->cron('6 10-20 * * * *');

        $schedule->call(function () {
            if (env('GROUP_NUM', false) === 4 ) {
                Log::info('JOB|TESTEMAIL|Started');
                $job_position = 'developer';
                $from_email_id = env('MAIL_USERNAME', false); 
                Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $from_email_id)
                {
                    $message->from($from_email_id, 'Madhu Mohan');
                    $message->to('xnjz2-5888762258@serv.craigslist.org');
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
                Log::info('JOB|TESTEMAIL|Ended');
            }
        })->cron('8 11-21 * * * *');

        $schedule->command('email:send')->cron('10,18,26,34,42,50 08-18 * * * *')->when(function () {
            if (env('GROUP_NUM', false) == 1 ) {
                return true;
            }
        });

        $schedule->command('email:send')->cron('12,20,28,36,44,52 09-19 * * * *')->when(function () {
            if (env('GROUP_NUM', false) == 2 ) {
                return true;
            }
        });

        $schedule->command('email:send')->cron('14,22,30,38,46,54 10-20 * * * *')->when(function () {
            if (env('GROUP_NUM', false) == 3 ) {
                return true;
            }
        });

        $schedule->command('email:send')->cron('16,24,32,40,48,56 11-21 * * * *')->when(function () {
            if (env('GROUP_NUM', false) == 4 ) {
                return true;
            }
        });


        // $schedule->call(function () {
        //     Log::info('JOB|SENDEMAIL|Started');
        //     $group_num = env('GROUP_NUM', false);
        //     if ($group_num == "") {
        //         Log::info('JOB|SENDEMAIL|Ended with Error - No Group Num in .env File');
        //         return 1;
        //     }

        //     $post = DB::table('posts')
        //         ->join('places', 'posts.place_id', '=', 'places.id')
        //         ->where('places.group_num',$group_num)
        //         ->where('posts.status','Got_Email')->whereNull('ignore_flg')->orderBy('post_date')
        //         ->select('posts.id','keyword_id','post_id','email_addr')->first();

        //     if (count($post)) {
        //         Log::info('JOB|SENDEMAIL|Running for POST:'.$post->post_id);
        //         $keyword = \App\Models\Keyword::find($post->keyword_id);
        //         $post_db = \App\Models\APosts::find($post->id);
        //         $job_position = strtolower($keyword->tech_text_1);
        //         $email_id = $post->email_addr;
        //         $from_email_id = env('MAIL_USERNAME', false); 
        //         if (strpos($email_id, 'craigslist') !== false) {
        //             Mail::send(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $email_id, $from_email_id)
        //             {
        //                 $message->from($from_email_id, 'Madhu Mohan');
        //                 // $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
        //                 $message->to($email_id);
        //                 // $message->to('maddy.10m@gmail.com');
        //                 $message->subject('Your craigslist ad for a '.strtolower($job_position));
        //             });
        //         } else {
        //             config([
        //                 'mail.host' => 'smtp.office365.com',
        //                 'mail.username' => 'madhu.mohan@etangerine.org',
        //                 'mail.password' => 'case@7892'
        //             ]);
        //             Mail::send(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $email_id)
        //             {
        //                 $message->from('madhum@etangerine.org', 'Madhu Mohan');
        //                 // $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
        //                 $message->to($email_id)->bcc('madhu.mohan@etangerine.org');
        //                 // $message->to('maddy.10m@gmail.com')->cc('madhu.mohan@etangerine.org');
        //                 $message->subject('Your craigslist ad for a '.strtolower($job_position));
        //             });
        //         }
        //         $post_db->status = "SENT_MAIL";
        //         $post_db->email_sent_at = date('Y-m-d H:i:s');
        //         $post_db->save();
        //         Log::info('JOB|SENDEMAIL|Ended for POST:'.$post->post_id);
        //     } else {
        //         Log::info('JOB|SENDEMAIL|Ended');
        //     }
        // })->cron('10,20,30,40,50 * * * * *');
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
