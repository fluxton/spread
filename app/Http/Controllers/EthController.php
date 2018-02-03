<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class EthController extends Controller
{
	protected $coin_symbol;
	protected $bittrex_client;
	protected $binance_client;
	protected $bitfinex_client;
	protected $bithumb_client;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->coin_symbol = 'eth';
		// Create a client with a base URI
		$this->bittrex_client = new Client(['base_uri' => 'https://bittrex.com/api/v1.1/public/']); //https://bittrex.com/api/v1.1/public/
		$this->binance_client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);  //https://api.binance.com/api/v1/ticker/24hr
		$this->bitfinex_client = new Client(['base_uri' => 'https://api.bitfinex.com/v2/tickers']); //https://api.bitfinex.com/v2/tickers?symbols=tBTCUSD
		$this->bithumb_client = new Client(['base_uri' => 'https://api.bithumb.com/public/ticker/']);  //https://api.bithumb.com/public/ticker/ETH
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Send a request to https://bittrex.com/api/v1.1/public/getmarketsummaries
		$usdt_bittrex = $this->getBittrexInfo('usdt');
		$btc_bittrex = $this->getBittrexInfo('btc');		

		$usdt_binance = $this->getBinanceInfo('usdt');
		$btc_binance = $this->getBinanceInfo('btc');

		$usdt_bitfinex = $this->getBitfinexInfo('usd');
		$btc_bitfinex = $this->getBitfinexInfo('btc');

		$krw_bithumb = $this->getBithumbInfo();

		$usd_bithumb = $krw_bithumb/1090;




		// $contents = [
		// 	'usdt_bittrex' => $usdt_bittrex,
		// 	'btc_bittrex' => $btc_bittrex,
		// 	'usdt_binance' => $usdt_binance,
		// 	'btc_binance' => $btc_binance,
		// 	'usdt_bitfinex' => $usdt_bitfinex,
		// 	'btc_bitfinex' => $btc_bitfinex,
		// 	'krw_bithumb' => $krw_bithumb,
		// 	'usd_bithumb' => $usd_bithumb,
		// ];
	

		// dd($contents);







		//dd($btc_coins);

		return view('ethereum.index',[
			'usdt_bittrex' => $usdt_bittrex,
			'btc_bittrex' => $btc_bittrex,
			'usdt_binance' => $usdt_binance,
			'btc_binance' => $btc_binance,
			'usdt_bitfinex' => $usdt_bitfinex,
			'btc_bitfinex' => $btc_bitfinex,
			'krw_bithumb' => $krw_bithumb,
			'usd_bithumb' => $usd_bithumb,
		]);
	}

	protected function getBittrexInfo($base_coin){ //https://bittrex.com/api/v1.1/public/getticker?market=usdt-eth

		$market = "$base_coin-$this->coin_symbol";// exampple "usdt-eth"
		$response = $this->bittrex_client->request('GET', 'getticker', ['query' => ['market' => $market]]);
		$res = json_decode($response->getBody(true)->getContents(),true);

		// "success": true,
		// "message": "",
		// "result": [
		// 		{
		// 		"MarketName": "USDT-ETH",
		// 		"High": 988.33,
		// 		"Low": 760,
		// 		"Volume": 40879.59146095,
		// 		"Last": 948.78801802,
		// 		"BaseVolume": 36663254.71938874,
		// 		"TimeStamp": "2018-02-03T09:45:57.197",
		// 		"Bid": 947.7,
		// 		"Ask": 948.78801802,
		// 		"OpenBuyOrders": 1265,
		// 		"OpenSellOrders": 1905,
		// 		"PrevDay": 885,
		// 		"Created": "2017-04-20T17:26:37.647"
		// 		}
		// 	]
		return $res['result']['Last'];
	}

	protected function getBinanceInfo($base_coin){ //https://api.binance.com/api/v1/ticker/24hr?symbol=ETHBTC

		$market = strtoupper($this->coin_symbol . $base_coin);// exampple "ETHBTC"
		$response = $this->binance_client->request('GET', '24hr', ['query' => ['symbol' => $market]]);
		$res = json_decode($response->getBody(true)->getContents());

		// "symbol": "ETHUSDT",
		// "priceChange": "64.58000000",
		// "priceChangePercent": "7.297",
		// "weightedAvgPrice": "908.80705413",
		// "prevClosePrice": "885.00000000",
		// "lastPrice": "949.57000000",
		// "lastQty": "0.12900000",
		// "bidPrice": "948.07000000",
		// "bidQty": "0.77201000",
		// "askPrice": "949.54000000",
		// "askQty": "0.20000000",
		// "openPrice": "884.99000000",
		// "highPrice": "988.42000000",
		// "lowPrice": "783.67000000",
		// "volume": "333530.34321000",
		// "quoteVolume": "303114728.67562490",
		// "openTime": 1517564261829,
		// "closeTime": 1517650661829,
		// "firstId": 8292825,
		// "lastId": 8761741,
		// "count": 468917

		return floatval($res->lastPrice);
	}

	protected function getBitfinexInfo($base_coin){ //https://api.bitfinex.com/v2/tickers?symbols=tETHUSD

		$market = "t" . strtoupper($this->coin_symbol . $base_coin);// exampple "ETHBTC"
		$response = $this->bitfinex_client->request('GET', '', ['query' => ['symbols' => $market]]);
		$res = json_decode($response->getBody(true)->getContents());

		//dd($res);

		// 0 => "tETHUSD"
	 //    1 => 948.55
	 //    2 => 554.52920361
	 //    3 => 948.9
	 //    4 => 430.10913923
	 //    5 => 59.01
	 //    6 => 0.0663
	 //    7 => 948.9
	 //    8 => 455833.35717812
	 //    9 => 986.31
	 //    10 => 768

		return floatval($res[0][7]);
	}

	protected function getBithumbInfo(){ //https://api.bithumb.com/public/ticker/ETH

		$coin = strtoupper($this->coin_symbol);// exampple "ETH"
		$response = $this->bithumb_client->request('GET', $coin);
		$res = json_decode($response->getBody(true)->getContents());

		//dd($res->data->sell_price);

		// +"status": "0000"
		//   +"data": {#273 ▼
		//     +"opening_price": "897000"
		//     +"closing_price": "959000"
		//     +"min_price": "744000"
		//     +"max_price": "1045000"
		//     +"average_price": "932495.3797"
		//     +"units_traded": "281027.0339459824588422"
		//     +"volume_1day": "281027.0339459824588422"
		//     +"volume_7day": "1372750.236674365716472710"
		//     +"buy_price": "956000"
		//     +"sell_price": "959000"
		//     +"date": "1517653888936"
		//   }

		return floatval($res->data->sell_price);
	}



}