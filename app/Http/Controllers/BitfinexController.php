<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class BitfinexController extends Controller
{
	protected $api_client;
	protected $symbols;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		// Create a client with a base URI

		$this->api_client = new Client(['base_uri' => 'https://api.bitfinex.com/v2/tickers']); //https://api.bitfinex.com/v2/tickers?symbols=tBTCUSD

		$temp_client = new Client(['base_uri' => 'https://api.bitfinex.com/v1/']);
		$response = $temp_client->request('GET', 'symbols');
		$this->symbols = array_map('strtoupper', json_decode($response->getBody(true)->getContents(),true)); 
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$query_string = "?symbols=t" . implode(",t",$this->symbols);
		
		//dd($query_string);
		// Send a request to https://bittrex.com/api/v1.1/public/getmarketsummaries
		$response = $this->api_client->request('GET', $query_string);

		$contents = json_decode($response->getBody(true)->getContents(),true);

		$contents = array_map(function($coin) {
			return  [//
				"symbol" => substr($coin[0], 1),
				//"bid" => $coin[1],
				//"bid_size" => $coin[2],
				//"ask" => $coin[3],
				//"ask_size" => $coin[4],
				"daily_change" => $coin[5],
				"daily_change_perc" => $coin[6]*100,
				"last_price" => $coin[7],
				"volume" => $coin[8]*$coin[7],				
				"high" => $coin[9],
				"low" => $coin[10]
			]; 
		}, $contents);

		//dd($contents);

		$filterBy = 'USD'; // ends with
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
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $usdt_coins);

		//dd($usdt_coins);

		usort($usdt_coins, function($a, $b) {
			return $b['volume'] - $a['volume'];
		});



		//dd($usdt_coins);

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
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $btc_coins);

		usort($btc_coins, function($a, $b) {
			return $b['volume'] - $a['volume'];
		});

		//dd($btc_coins);

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
			$var['symbol'] = substr($string,  0 , $strlen - $testlen);
			return $var;	
		}, $eth_coins);

		usort($eth_coins, function($a, $b) {
			return $b['volume'] - $a['volume'];
		});

		//dd($btc_coins);

		return view('bitfinex.index',[
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