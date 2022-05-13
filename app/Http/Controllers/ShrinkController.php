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
        $data['shrunk_url'] = Str::random(5);
        // add to db
        ShortLink::create($data);
        //call function to get page title for submitted URL
        $this->getTitle($request->url);

        $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $data['link'] = $domain.'/'.$data['shrunk_url'];
        $data['success'] = 'Shorten Link Generated Successfully!';

        return response()->json($data);

        // return redirect('/')->with('success', '');


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

    public function shorternLink($code){

        // get original URL from database 
        $getLink = ShortLink::where('shrunk_url', $code)->first();

        // update tries when link is accessed
        ShortLink::where('shrunk_url', $code)
        ->update([
            'tries' => $getLink->tries + 1
        ]);

        return redirect($getLink->url);

    }

    public function viewLinks()
    {
        $shortLinks = ShortLink::latest()->get();
        $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // $domain =  parse_url($actual_link);

        //scrape title 
        
        return view('pages.shrink.view', compact('shortLinks', 'domain'));
    }

    public function getTopLinks(Request $request)
    {
        $data['data'] = ShortLink::select('url', 'tries', 'title')
        ->take(100)
        // ->where('tries', '>', 0)
        ->orderBy('tries', 'DESC')
        ->get();

        return response()->json($data);
    }
}
