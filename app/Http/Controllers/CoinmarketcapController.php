<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

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
    public function index()
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


    	$contents = json_decode($response->getBody(true)->getContents(),true);

        // function remove number( $name ) {
        //     return "Hello " . ucfirst( $name ) . "!";
        // }

        // $coins = ( array_map( function( $coin ) {
        //     return "Hello " . ucfirst( $name ) . "!";
        // }, $names ) );

    	//$contents = $response->getBody()->getContents();

    	//dd($contents);

    	//return $response;


      return view('coinmarketcap.index',[
          'coins' => $contents
      ]);
  }
}
