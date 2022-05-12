<?php

namespace App\Jobs;

use App\Models\ShortLink;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetPageTitle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

       //create new client object to host request
       $client = new Client();
        // get URL
       $page = $client->request('GET', $this->url);
       
       // //get page title 
       $title = $page->filter('title')->text();
       // //update table with captured page title
       ShortLink::where('url', $this->url)
       ->update([
           'title' => $title
       ]);
    }
}
