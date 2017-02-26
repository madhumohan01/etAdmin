<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('JOB|SENDEMAIL|Started');
        $group_num = env('GROUP_NUM', false);
        if ($group_num == "") {
            Log::info('JOB|SENDEMAIL|Ended with Error - No Group Num in .env File');
            return 1;
        }

        $post = DB::table('posts')
            ->join('places', 'posts.place_id', '=', 'places.id')
            ->where(function ($query) use ($group_num) {
                $query->where('places.group_num',$group_num)
                    ->orWhere('places.group_num',$group_num+4);
            })
            ->where('posts.status','Got_Email')->whereNull('ignore_flg')->orderBy('post_date')
            ->select('posts.id','keyword_id','post_id','email_addr')->first();

        if (count($post)) {
            Log::info('JOB|SENDEMAIL|Running for POST:'.$post->post_id);
            $keyword = \App\Models\Keyword::find($post->keyword_id);
            $post_db = \App\Models\APosts::find($post->id);
            $job_position = strtolower($keyword->tech_text_1);
            $email_id = $post->email_addr;
            $from_email_id = env('MAIL_USERNAME', false); 
            if (strpos($email_id, 'craigslist') !== false) {
                Mail::send(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $email_id, $from_email_id)
                {
                    $message->from($from_email_id, 'Madhu Mohan');
                    // $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
                    $message->to($email_id);
                    // $message->to('maddy.10m@gmail.com');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
            } else {
                config([
                    'mail.host' => 'smtp.office365.com',
                    'mail.username' => 'madhu.mohan@etangerine.org',
                    'mail.password' => 'case@7893'
                ]);
                Mail::send(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position, $email_id)
                {
                    $message->from('madhum@etangerine.org', 'Madhu Mohan');
                    // $message->to('xnjz2-5888762258@serv.craigslist.org')->cc('madhu.mohan@etangerine.org');
                    $message->to($email_id);
                    // $message->to('maddy.10m@gmail.com')->cc('madhu.mohan@etangerine.org');
                    $message->subject('Your craigslist ad for a '.strtolower($job_position));
                });
            }
            $post_db->status = "SENT_MAIL";
            $post_db->email_sent_at = date('Y-m-d H:i:s');
            $post_db->save();
            Log::info('JOB|SENDEMAIL|Ended for POST:'.$post->post_id);
        } else {
            Log::info('JOB|SENDEMAIL|Ended');
        }
    }
}
