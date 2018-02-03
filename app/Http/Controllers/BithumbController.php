<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class BithumbController extends Controller
{
	protected $krw_to_usd = 0.00094;
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
		$client = new Client(['base_uri' => 'https://api.bithumb.com/public/ticker/']);  //https://api.bithumb.com/public/ticker/all
		// Send a request to https://api.bithumb.com/public/ticker
		$response = $client->request('GET', 'all');

		$content = json_decode($response->getBody(true)->getContents(),true);
		$coins = $content['data'];

		$krw_to_usd = 0.00094;

		$usd_coins = [];

		

		foreach ($coins as $key => $value) {
			if (is_array($value)){
				$value = array_map(function($a) {
	 				return $a * 0.00094;
				}, $value);
				$usd_coins[$key] = $value;
			}
		}
		
		
// dd($coins);
// 		usort($coins, function($a, $b) {
// 			return $b['volume_1day'] - $a['volume_1day'];
// 		});


		return view('bithumb.index',[
          'coins' => $usd_coins
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

