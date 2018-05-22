<?php

namespace App\Http\Controllers;

use App\Models\CoinmarketcapModel;
//use GuzzleHttp\Client;

class CoinmarketcapController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index() {
//
//        // Create a client with a base URI
//        $client = new Client(['base_uri' => 'https://api.coinmarketcap.com/v1/ticker/']);  //https://api.coinmarketcap.com/v1/ticker/?limit=10
//        // Send a request to https://api.coinmarketcap.com/v1/ticker/bitcoin
//        $response = $client->request('GET', '?limit=50');
//
//
//        $contents = json_decode($response->getBody(true)->getContents(), true);
//        //dd($contents);
//
//        return view('coinmarketcap.index', [
//            'coins' => $contents
//        ]);
//    }

    public function index() {
        
        $client = new CoinmarketcapModel();

        $content =  json_decode($client->getData(), true); //you can pass limit of data, default is 50
        
        //dd($content);

        return view('coinmarketcap.index', [
            'coins' => $content
        ]);
    }
}
