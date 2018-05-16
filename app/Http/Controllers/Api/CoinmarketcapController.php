<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use GuzzleHttp\Client;

class CoinmarketcapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	//$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {

    	// $client = new Client([
    	// 	// Base URI is used with relative requests
    	// 	'base_uri' => 'https://api.coinmarketcap.com/v1/ticker/',
    	// 	// You can set any number of default request options.
    	// 	'timeout'  => 2.0,
    	// ]);

    	// Create a client with a base URI
    	$client = new Client(['base_uri' => 'https://api.coinmarketcap.com/v1/ticker/']);  //https://api.coinmarketcap.com/v1/ticker/?limit=10
		// Send a request to https://api.coinmarketcap.com/v1/ticker/bitcoin
    	$response = $client->request('GET', '?limit=50');

        return $response->getBody(true)->getContents();


    	// $contents = json_decode($response->getBody(true)->getContents(),true);


     //    return json_encode(
     //        'data' => [
     //            'coins' => $contents
     //        ],
     //        'message' => 'ok'
     //        );
  }
}
