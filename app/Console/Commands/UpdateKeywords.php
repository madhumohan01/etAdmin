<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UpdateKeywords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:keywords';

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
        Log::info('JOB|UPDATEKEYWORDS|Started');
        $group_num = env('GROUP_NUM', false);
        if ($group_num == "") {
            Log::info('JOB|UPDATEKEYWORDS|Ended with Error - No Group Num in .env File');
            return 1;
        }

        if ($group_num == "1") {
            $posts = \App\Models\APosts::where('status','Downloaded')->orderBy('id')->get();

            ini_set('max_execution_time', 10000);
            foreach ($posts as $post) {
                Log::info('JOB|UPDATEKEYWORDS|Running for POST:'.$post->post_id);
                $post->heading = str_replace("'","",$post->heading);
                $post->save();
                $keyword = DB::table('keywords')
                    ->whereRaw("instr('".$post->heading."',tech_name)")
                    ->whereNull('deleted_at')
                    ->orderBy('seq_no')->first();
                // echo $keyword->tech_name;
                if (count($keyword)) {
                    $post->keyword_id = $keyword->id;
                    $post->status = 'Got_KW';
                    $post->save();
                } else {
                    $post->ignore_flg = true;
                    $post->status = 'Got_KW';
                    $post->save();
                }
                Log::info('JOB|UPDATEKEYWORDS|Ended for POST:'.$post->post_id);
            }
            ini_set('max_execution_time', 120);
        }
        Log::info('JOB|SENDEMAIL|Ended');
    }
}