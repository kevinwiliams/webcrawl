<?php

namespace App\Http\Controllers;

use App\Jobs\GetPageTitle;
use Illuminate\Http\Request;
use App\Models\ShortLink;
use Goutte\Client;
use Illuminate\Support\Str;

class ShrinkController extends Controller
{
    public function index(){

        return view('pages.shrink.index');
    }

    public function shrink(Request $request){

        $request->validate([
            'url'=> 'required|url'
        ]);

        $data['url'] = $request->url;
        $data['shrunk_url'] = 'https://'.Str::random(5).'.shrt';

        ShortLink::create($data);

        $this->getTitle($request->url);

        return redirect('/')->with('success', 'Shorten Link Generated Successfully!');


    }

    public function getTitle($url)
    {
        GetPageTitle::dispatch($url);
        /*
        //create new client object to host request
        $client = new Client();

        $page = $client->request('GET', $url);
        
        // //get page title 
        $title = $page->filter('title')->text();
        // //update table with captured page title
        ShortLink::where('url', $url)
        ->update([
            'title' => $title
        ]);
        */
        // echo "<pre>";
        // print_r($page);
        //return $title;

    }

    public function shorternLink($id){

        // get original URL from database 
        $getLink = ShortLink::where('id', $id)->first();

        // update tries when link is accessed
        ShortLink::where('id', $getLink->id)
        ->update([
            'tries' => $getLink->tries + 1
        ]);

        return redirect($getLink->url);

    }

    public function viewLinks()
    {
        $shortLinks = ShortLink::latest()->get();

        //scrape title 
        
        return view('pages.shrink.view', compact('shortLinks'));
    }
}
