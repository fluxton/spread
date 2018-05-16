<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use GuzzleHttp\Client;
//use GuzzleHttp\Response;

class BithumbController extends Controller
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
		// Create a client with a base URI
		$client = new Client(['base_uri' => 'https://api.bithumb.com/public/ticker/']);  //https://api.bithumb.com/public/ticker/all
		// Send a request to https://api.bithumb.com/public/ticker
		$response = $client->request('GET', 'all');

		$content = json_decode($response->getBody(true)->getContents(),true);
		if(empty($content['data'])) {
			if(!empty($content['message'])){
				$message = $content['message'];
				$string = "<p>problems with bithumb APIs</p><p>" . $message ."</p>";
				return $string;
			}
			else{
				return "<p>problems with bithumb APIs</p>";
			}			
		}

		$coins = array_filter($content['data'], function($val) { return is_array($val); });

		$time_client = new Client(['base_uri' => 'https://api.fixer.io/latest']);  //https://api.fixer.io/latest?base=KRW&symbols=USD

		$time_response = $time_client->request('GET', '?base=KRW&symbols=USD');

		$content1 = json_decode($time_response->getBody(true)->getContents());

		$getKrwToUsdRate = $content1->rates->USD;

		return json_encode([
			'data' => [
				'coins' => $coins,
				'exchange_rate' => $getKrwToUsdRate
			],
			'message' => 'ok'
		]);
	}
}

// "BTC": {
// "opening_price": "12590000",
// "closing_price": "11441000",
// "min_price": "10555000",
// "max_price": "12650000",
// "average_price": "11650106.2946",
// "units_traded": "12120.66110718",
// "volume_1day": "12120.66110718",
// "volume_7day": "79819.19231880",
// "buy_price": "11440000",
// "sell_price": "11441000"
// }

