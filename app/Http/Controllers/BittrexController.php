<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class BittrexController extends Controller
{
	protected $api_client;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		// Create a client with a base URI
		$this->api_client = new Client(['base_uri' => 'https://bittrex.com/api/v1.1/public/']);  //https://bittrex.com/api/v1.1/public/getmarketsummaries
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Send a request to https://bittrex.com/api/v1.1/public/getmarketsummaries
		$response = $this->api_client->request('GET', 'getmarketsummaries');

		$res = json_decode($response->getBody(true)->getContents(),true);

		$contents = $res['result'];

		//dd($contents);



		$filterBy = 'USDT'; // ends with

		$usdt_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , 0 , $testlen) === 0;    		
		});

		$usdt_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return;
			$var['MarketName'] = substr($string,  $testlen + 1 , $strlen - $testlen);
			$var['Change24h'] = $var['Last'] - $var['PrevDay'];
			$var['ChangePercent24h'] = $var['Change24h'] / $var['PrevDay'] * 100;
			return $var;	
		}, $usdt_coins);

		usort($usdt_coins, function($a, $b) {
			return $b['BaseVolume'] - $a['BaseVolume'];
		});

		//dd($usdt_coins);

		$filterBy = 'BTC'; // ends with

		$btc_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , 0 , $testlen) === 0;    		
		});

		$btc_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);			
			$var['MarketName'] = substr($string,  $testlen + 1 , $strlen - $testlen);
			$var['Change24h'] = $var['Last'] - $var['PrevDay'];
			$var['ChangePercent24h'] = $var['Change24h'] / $var['PrevDay'] * 100;
			return $var;	
		}, $btc_coins);

		usort($btc_coins, function($a, $b) {
			return $b['BaseVolume'] - $a['BaseVolume'];
		});

		//dd($btc_coins);

		$filterBy = 'ETH'; // ends with

		$eth_coins = array_filter($contents, function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);
			if ($strlen < $testlen) return false;
			return substr_compare($string, $filterBy , 0 , $testlen) === 0;    		
		});

		$eth_coins = array_map(function ($var) use ($filterBy) {
			$string = $var['MarketName'];
			$strlen = strlen($string);
			$testlen = strlen($filterBy);			
			$var['MarketName'] = substr($string,  $testlen + 1 , $strlen - $testlen);
			$var['Change24h'] = $var['Last'] - $var['PrevDay'];
			$var['ChangePercent24h'] = $var['Change24h'] / $var['PrevDay'] * 100;
			return $var;	
		}, $eth_coins);

		usort($eth_coins, function($a, $b) {
			return $b['BaseVolume'] - $a['BaseVolume'];
		});

		//dd($btc_coins);

		return view('bittrex.index',[
			'usdt_coins' => $usdt_coins,
			'btc_coins' => $btc_coins,
			'eth_coins' => $eth_coins,
		]);
	}
}


// 		{
// "MarketName": "USDT-ADA",
// "High": 0.52180897,
// "Low": 0.47000001,
// "Volume": 3973860.78129699,
// "Last": 0.51335656,
// "BaseVolume": 1969692.29553585,
// "TimeStamp": "2018-02-01T03:25:56.603",
// "Bid": 0.51068,
// "Ask": 0.51335656,
// "OpenBuyOrders": 888,
// "OpenSellOrders": 4699,
// "PrevDay": 0.49508427,
// "Created": "2017-12-29T19:24:39.987"
// }