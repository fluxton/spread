<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class BinanceController extends Controller
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
		// Create a client with a base URI
		$client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);  //https://api.binance.com/api/v1/ticker/24hr
		// Send a request to https://api.coinmarketcap.com/v1/ticker/bitcoin
		$response = $client->request('GET', '24hr');

		$contents = json_decode($response->getBody(true)->getContents(),true);

		$filterBy = 'USDT'; // ends with

		$usdt_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , $strlen - $testlen, $testlen) === 0;    		
		});

		$usdt_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return;
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $usdt_coins);

		usort($usdt_coins, function($a, $b) {
			return $b['quoteVolume'] - $a['quoteVolume'];
		});

		$filterBy = 'BTC'; // ends with

		$btc_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , $strlen - $testlen, $testlen) === 0;    		
		});

		$btc_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return;
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $btc_coins);
		usort($btc_coins, function($a, $b) {
			return $b['quoteVolume'] - $a['quoteVolume'];
		});

		//dd($coins);

		$filterBy = 'ETH'; // ends with

		$eth_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , $strlen - $testlen, $testlen) === 0;    		
		});

		$eth_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['symbol'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return;
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $eth_coins);
		usort($eth_coins, function($a, $b) {
			return $b['quoteVolume'] - $a['quoteVolume'];
		});

		//dd($coins);

		return view('binance.index',[
			'usdt_coins' => $usdt_coins,
			'btc_coins' => $btc_coins,
			'eth_coins' => $eth_coins,
		]);
	}
}


