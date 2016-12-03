<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->getPosts();
        // $this->updateKeywords();
        // $this->sendTestEmail();
        $this->sendEmail();

        
        return "true";
    }

    public function updateKeywords() {
        $posts = \App\Models\APosts::where('status',"=",'Downloaded')->orderBy('id')->get();
        foreach ($posts as $post) {
            // echo $post->heading;
            $keyword = DB::table('keywords')
                ->whereRaw("instr('".$post->heading."',tech_name)")
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
        }
    }

    public function sendTestEmail() {
        
        $job_position = 'developer';
        // echo $keyword->tech_name;
        Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position)
        {
            $message->from('madhum@etangerine.org', 'Madhu Mohan');
            $message->to('xnjz2-5888762258@serv.craigslist.org');
            // $message->to('maddy.10m@gmail.com');
            $message->subject('Your craigslist ad for a '.strtolower($job_position));
        });
    }


    public function sendEmail() {
        $post = \App\Models\APosts::where('status',"=",'Got_Email')->whereNull('ignore_flg')->orderBy('post_date')->first();
        if (count($post)) {
            // echo $post->heading;
            // echo $post->email_addr;
            // $keyword = DB::table('keywords')
            //     ->whereRaw("instr('".$post->heading."',tech_name)")
            //     ->orderBy('seq_no')->first();
            $keyword = $post->keyword()->first();
            // $keyword = \App\Models\APosts::find($post->keyword_id);
            $job_position = strtolower($keyword->tech_text_1);
            // echo $keyword->tech_name;
            Mail::queue(['text' =>'emails.outsource_1_text'], ['job_position' => $job_position ],function ($message) use ($job_position)
            {
                $message->from('madhum@etangerine.org', 'Madhu Mohan');
                // $message->to('xnjz2-5888762258@serv.craigslist.org');
                $message->to('maddy.10m@gmail.com');
                $message->subject('Your craigslist ad for a '.strtolower($job_position));
            });
            // $post->status = "SENT_MAIL";
            // $post->save();
        }
    }

    public function getEmails() {
        $posts = \App\Models\APosts::where('status',"=",'Downloaded')->orderBy('id')->take(15)->get();
        if (count($posts)) {
            foreach ($posts as $post) {
                $place = $post->place()->first();
                $section = $post->section()->first();
                $email_url = $place->url.'/reply/'.$place->email_url.'/'.$section->url.'/'.$post->post_id;

                $ch = curl_init(); 
                curl_setopt($ch, CURLOPT_URL, $email_url); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLINFO_HEADER_OUT, true); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest", "Accept-Encoding: gzip, deflate", "Accept-Language: en-US,en;q=0.5"));
                curl_setopt($ch, CURLOPT_REFERER, $post->job_link);
                curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0'); 
                $output = curl_exec($ch); 
                $info = curl_getinfo($ch);
                curl_close($ch);  
                $html = gzdecode($output);
                $crawler = new Crawler($html);
                $address_dom = $crawler->filter('.mailapp');
                if ($address_dom->count() != 0) {
                    $email = $address_dom->first()->text();
                    $post->email_addr = $email;
                    $post->status = "Got_Email";
                    echo $email;
                } else {
                    $post->status = "No_Email";
                }
                $post->save();
            }
        }
    }


    public function getPosts() {
        ini_set('max_execution_time', 10000);
        $places = \App\Models\Place::where('status','=','Ready')->get();
        $sections = \App\Models\Section::where('status','=','Ready')->get();
        Log::info('JOB|GETRSSDATA|Started');
        foreach ($places as $place) {            
            foreach ($sections as $section) {
                $url = $place->url."/search/".$section->url."?format=rss";
                if ($place->name == 'Montreal') {
                    $url = $place->url."/search/".$section->url."?lang=en&cc=us&format=rss";
                }
                sleep(6);
                Log::info('JOB|GETRSSDATA|Starting Download of RSS File For Place: '.$place->name.', Section:'.$section->name);

                $encoded_xml = @file_get_contents($url, true);
                if($encoded_xml === false) {
                    Log::info('JOB|GETRSSDATA|error. Retrying in 65 seconds.');
                    sleep(65);
                    $encoded_xml = @file_get_contents($url, true);
                    if($encoded_xml === false) {
                        Log::info('JOB|GETRSSDATA|error again. Not Retrying.');
                        continue;
                    }
                } 
                $xml = utf8_encode($encoded_xml);
                
                $data = new \SimpleXmlElement($xml);
                $processed = 0;
                $added = 0;
                foreach ($data->item as $item) {
                    $processed++;
                    $ns_dc = $item->children('http://purl.org/dc/elements/1.1/');
                    $post_id = $this->findPostId($item->link);
                    $post = \App\Models\APosts::where('post_id',"=",$post_id)->get();
                    if ($post->isEmpty()) {
                        $post = new \App\Models\APosts;
                        $post->place_id=$place->id;
                        $post->section_id=$section->id;
                        $post->post_id=$post_id;                        
                        
                        $datetime = new \DateTime($ns_dc->date);
                        $eastern_time = new \DateTimeZone('America/Toronto');
                        $datetime->setTimezone($eastern_time);
                        $post->post_date = $datetime->format('Y-m-d H:i:s');

                        $post->heading=$item->title;
                        $post->description=$item->description;
                        $post->job_link=$item->link;
                        $post->status='Downloaded';
                        $post->save();
                        $added++;
                    } 
                    
                }
                Log::info('JOB|GETRSSDATA|Completed Download of RSS File For Place: '.$place->name.', Section:'.$section->name.'|Stats: Received - '.$processed.', Added - '.$added);
            }
        }
        Log::info('JOB|GETRSSDATA|Completed');
        ini_set('max_execution_time', 120);
    }

    public function findPostId($input) {
        // Input will be the URL of the post: http://sfbay.craigslist.org/sfc/apa/5889975220.html
        $temp = explode("/",$input);
        // echo count($temp1);
        // echo $temp1[count($temp1)-1];
        $temp1 = explode('.',$temp[count($temp)-1]);
        return $temp1[0];
    }
}
