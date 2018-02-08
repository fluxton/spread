<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Response;

class SpreadController extends Controller
{
	// protected $bittrex_client;
	// protected $binance_client;
	// protected $bitfinex_client;
	// protected $bithumb_client;
	protected $symbols; 

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');

		$this->symbols = [
			// "BTC",
			// "LTC",
			// "ETH",
			// "ETC",
			// "ZEC",
			// "XMR",
			// "DSH",
			// "XRP",
			// "EOS",
			// "BCH",
			// "QTM",
			// "BTG",
			// "NEO"
		];
		
		// // Create a client with a base URI
		// $this->bittrex_client = new Client(['base_uri' => 'https://bittrex.com/api/v1.1/public/']); //https://bittrex.com/api/v1.1/public/getmarketsummaries
		// $this->binance_client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);  //https://api.binance.com/api/v1/ticker/24hr
		// $this->bitfinex_client = new Client(['base_uri' => 'https://api.bitfinex.com/v2/tickers']); //https://api.bitfinex.com/v2/tickers?symbols=tBTCUSD
		// $this->bithumb_client = new Client(['base_uri' => 'https://api.bithumb.com/public/ticker/']);  //https://api.bithumb.com/public/ticker/all
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function bithumb()
	{

		$coin_prices = [];

		$coin_prices['bithumb'] = $this->getBithumbInfo($this->symbols);
		$coin_prices['bittrex'] = $this->getBittrexInfo($this->symbols)['USDT'];
		$coin_prices['binance'] = $this->getBinanceInfo($this->symbols)['USDT'];
		//$coin_prices['bitfinex'] = $this->getBitfinexInfo($this->$symbols);

		//dd($coin_prices);

		$symbols_avail = $coin_prices['bithumb'];

		//dd($symbols_avail);

		$full_spread = [] ;

		foreach($symbols_avail as $coin_symbol => $same_value){
			$bithumb_price = $coin_prices['bithumb'][$coin_symbol];
			foreach ($coin_prices as $market_name => $coin_prices_market) {
				if(isset($coin_prices_market[$coin_symbol])){
					$full_spread[$coin_symbol][$market_name] = $coin_prices_market[$coin_symbol];

					if ($market_name != 'bithumb'){
						$full_spread[$coin_symbol][$market_name."-diff"] = $coin_prices_market[$coin_symbol]-$bithumb_price;
						$full_spread[$coin_symbol][$market_name."-diff-perc"] = ($coin_prices_market[$coin_symbol]-$bithumb_price)*100/$bithumb_price;
					}
				}
				// else{
				// 	$full_spread[$coin_symbol][$market_name] = 0000;
				// 	$full_spread[$coin_symbol][$market_name."-diff"] = 0000;
				// 	$full_spread[$coin_symbol][$market_name."-diff-perc"] = 0000;
				// }
			}

		}

		$available_withdrawal = ['BTC','ETH','DASH','LTC','ETC','XRP','BCH','XMR','ZEC','QTUM'];

		//dd($full_spread);

		return view('spread.bithumb',[
			'data' => $full_spread,
			'available_withdrawal' => $available_withdrawal,
		]);
	}

	public function binance()
	{

		$coin_prices = [];

		//$coin_prices['bithumb'] = $this->getBithumbInfo($symbols);
		$coin_prices['bittrex'] = $this->getBittrexInfo($this->symbols);
		$coin_prices['binance'] = $this->getBinanceInfo($this->symbols);
		$coin_prices['bitfinex'] = $this->getBitfinexInfo($this->symbols);

		//dd($coin_prices);

		$symbols_avail = $coin_prices['binance'];

		//dd($symbols_avail);

		$full_spread = [
			'USDT' => [],
			'BTC' => [],
			'ETH' => [],
		] ;

		$market_coins_available = ['USDT','BTC','ETH'];

		$markets = ['bittrex','bitfinex'];

		foreach ($market_coins_available as $coin_available) {
			//echo " <br><br> +++++++++++++++++++++++++++++++++  <br> coin : " . $coin_available . "<br><br>";

			foreach($coin_prices['binance'][$coin_available] as $coin_symbol => $binance_price){
				//echo " <br> ------------------------------  <br> coin_symbol : " . $coin_symbol . " , binance price : " .  $binance_price . "<br>";
				$full_spread[$coin_available][$coin_symbol] = [];
				$full_spread[$coin_available][$coin_symbol]['binance'] = $binance_price;

				foreach ($markets as $market_name) {
					if(isset($coin_prices[$market_name][$coin_available][$coin_symbol])){
						//echo " market : " . $market_name . " , price : " . $coin_prices[$market_name][$coin_available][$coin_symbol] . "<br>";
						$full_spread[$coin_available][$coin_symbol][$market_name] = $coin_prices[$market_name][$coin_available][$coin_symbol];
						$full_spread[$coin_available][$coin_symbol][$market_name."-diff"] = $coin_prices[$market_name][$coin_available][$coin_symbol]-$binance_price;
						$full_spread[$coin_available][$coin_symbol][$market_name."-diff-perc"] = ($coin_prices[$market_name][$coin_available][$coin_symbol]-$binance_price)*100/$binance_price;
					}
				}

			}

		
		}

		//dd($full_spread);//

		return view('spread.binance',[
			'data' => $full_spread
		]);
	}

	public function bittrex()
	{

		$coin_prices = [];

		//$coin_prices['bithumb'] = $this->getBithumbInfo($symbols);
		$coin_prices['bittrex'] = $this->getBittrexInfo($this->symbols);
		$coin_prices['binance'] = $this->getBinanceInfo($this->symbols);
		$coin_prices['bitfinex'] = $this->getBitfinexInfo($this->symbols);

		//dd($coin_prices);

		$symbols_avail = $coin_prices['bittrex'];

		//dd($symbols_avail);

		$full_spread = [
			'USDT' => [],
			'BTC' => [],
			'ETH' => [],
		] ;

		$market_coins_available = ['USDT','BTC','ETH'];

		$markets = ['binance','bitfinex'];

		foreach ($market_coins_available as $coin_available) {
			//echo " <br><br> +++++++++++++++++++++++++++++++++  <br> coin : " . $coin_available . "<br><br>";

			foreach($coin_prices['bittrex'][$coin_available] as $coin_symbol => $bittrex_price){
				//echo " <br> ------------------------------  <br> coin_symbol : " . $coin_symbol . " , binance price : " .  $bittrex_price . "<br>";
				$full_spread[$coin_available][$coin_symbol] = [];
				$full_spread[$coin_available][$coin_symbol]['bittrex'] = $bittrex_price;

				foreach ($markets as $market_name) {
					if(isset($coin_prices[$market_name][$coin_available][$coin_symbol])){
						//echo " market : " . $market_name . " , price : " . $coin_prices[$market_name][$coin_available][$coin_symbol] . "<br>";
						$full_spread[$coin_available][$coin_symbol][$market_name] = $coin_prices[$market_name][$coin_available][$coin_symbol];
						$full_spread[$coin_available][$coin_symbol][$market_name."-diff"] = $coin_prices[$market_name][$coin_available][$coin_symbol]-$bittrex_price;
						$full_spread[$coin_available][$coin_symbol][$market_name."-diff-perc"] = ($coin_prices[$market_name][$coin_available][$coin_symbol]-$bittrex_price)*100/$bittrex_price;
					}
				}

			}

		
		}

		//dd($full_spread);//

		return view('spread.bittrex',[
			'data' => $full_spread
		]);
	}

	protected function getBittrexInfo($symbols){ 

		$client = new Client(['base_uri' => 'https://bittrex.com/api/v1.1/public/']);

		$response = $client->request('GET', 'getmarketsummaries');

		$res = json_decode($response->getBody(true)->getContents(),true);

		$contents = $res['result'];

		//dd($contents);

		//$coins = [];

		if(!empty($symbols)){
			$coins = array_filter($contents, function ($var) use ($symbols) {
			$string = $var['MarketName'];
			//$string = substr($string,  -3 , 3);
			$string = substr($string, strpos($string, "-") + 1);  
			//echo $string . PHP_EOL;;
			return ($string == 'BCC') || in_array($string, $symbols);    		
			});
		}
		else{
			$coins = $contents;
		}

		//dd($coins);

		usort($coins, function($a, $b) {
			return floatval($b['BaseVolume']) <=> floatval($a['BaseVolume']);
		});

		//dd($coins);

		$usdt_coins = [];
		$btc_coins = [];
		$eth_coins = [];

		foreach ($coins as $coin) {
			$string = $coin['MarketName'];
			$symbol = substr($string, strpos($string, "-") + 1);
			if ($symbol == 'BCC'){
				$symbol = 'BCH';				
			}
			if(substr_compare($string, 'USDT' , 0, 4) === 0){
				$usdt_coins[$symbol] = $coin['Last'];
			}
			else if(substr_compare($string, 'BTC' , 0, 3) === 0){
				$btc_coins[$symbol] = $coin['Last'];
			}
			else if(substr_compare($string, 'ETH' , 0, 3) === 0){
				$eth_coins[$symbol] = $coin['Last'];
			}
		}




		$coins = [
			'USDT' => $usdt_coins,
			'BTC' => $btc_coins,
			'ETH' => $eth_coins,
		];

		//dd($coins);

		return $coins;
	}

	protected function getBinanceInfo($symbols){ 

		$client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);  

		$response = $client->request('GET', '24hr');

		$contents = json_decode($response->getBody(true)->getContents(),true);

		if(!empty($symbols)){
			$coins = array_filter($contents, function ($var) use ($symbols) {
			$string = $var['symbol'];
			$string = substr($string,  0 , 3);
			return ($string == 'BCC') || in_array($string, $symbols);    		
			});
		}
		else{
			$coins = $contents;
		}	

		usort($coins, function($a, $b) {
			return $b['volume'] - $a['volume'];
		});

		$usdt_coins = [];
		$btc_coins = [];
		$eth_coins = [];

		foreach ($coins as $coin) {
			$string = $coin['symbol'];
			$symbol = substr($string,  0 , 3);
			if ($symbol == 'BCC') $symbol = 'BCH';		
			if(substr_compare($string, 'USDT' , 3, 4) === 0){
				$usdt_coins[$symbol] = $coin['lastPrice'];
			}
			else if(substr_compare($string, 'BTC' , 3, 3) === 0){
				$btc_coins[$symbol] = $coin['lastPrice'];
			}
			else if(substr_compare($string, 'ETH' , 3, 3) === 0){
				$eth_coins[$symbol] = $coin['lastPrice'];
			}
		}

		

		$coins = [
			'USDT' => $usdt_coins,
			'BTC' => $btc_coins,
			'ETH' => $eth_coins,
		];

		//dd($coins);

		return $coins;
	}

	protected function getBitfinexInfo($symbols){ //https://api.bitfinex.com/v2/tickers?symbols=tETHUSD,tETHBTC,

		 //https://api.bitfinex.com/v2/tickers?symbols=tBTCUSD


		$temp_client = new Client(['base_uri' => 'https://api.bitfinex.com/v1/']);
		$response = $temp_client->request('GET', 'symbols');
		$temp_symbols = array_map('strtoupper', json_decode($response->getBody(true)->getContents(),true));
		if(!empty($symbols)){
			$query_symbols = array_filter($temp_symbols, function ($var) use ($symbols) {
				//echo $var . "<br>";
			$string = substr($var,  0 , 3);
			return in_array($string, $symbols);    		
			});	
		}
		else{
			$query_symbols = $temp_symbols;
		}	
			

		$query_string = "?symbols=t" . implode(",t", $query_symbols);

		//dd($query_string);

		$client = new Client(['base_uri' => 'https://api.bitfinex.com/v2/tickers']);
		
		$response = $client->request('GET', $query_string);

		$contents = json_decode($response->getBody(true)->getContents(),true);

		// if(!empty($symbols)){
		// 	$coins = array_filter($contents, function ($var) use ($symbols) {
		// 	$string = $var[0];
		// 	$string = substr($string,  1 , 3);
		// 	return in_array($string, $symbols);    		
		// 	});
		// }
		// else{
		// 	$coins = $contents;
		// }	

		usort($contents, function($a, $b) {
			return $b[8] - $a[8];
		});

		

		$usdt_coins = [];
		$btc_coins = [];
		$eth_coins = [];

		foreach ($contents as $coin) {
			$string = $coin[0];
			$strlen = strlen($string);
			if(substr_compare($string, 'USD' , 4, 3) === 0){
				$usdt_coins[substr($string,  1 , 3)] = $coin[7];
			}
			else if(substr_compare($string, 'BTC' , 4, 3) === 0){
				$btc_coins[substr($string,  1 , 3)] = $coin[7];
			}
			else if(substr_compare($string, 'ETH' , 4, 3) === 0){
				$eth_coins[substr($string,  1 , 3)] = $coin[7];
			}
		}

		$coins = [
			'USDT' => $usdt_coins,
			'BTC' => $btc_coins,
			'ETH' => $eth_coins,
		];

		//dd($coins);	

		return $coins;
	}

	protected function getBithumbInfo($symbols){ 

		$client = new Client(['base_uri' => 'https://api.bithumb.com/public/ticker/']);  //https://api.bithumb.com/public/ticker/all
		// Send a request to https://api.bithumb.com/public/ticker
		$response = $client->request('GET', 'all');

		$content = json_decode($response->getBody(true)->getContents(),true);

		$contents = $content['data'];

		if(!empty($symbols)){
			$coins = array_filter($contents, function ($var) use ($symbols) {
			$string = $var[0];
			return in_array($string, $symbols);    		
			});
		}
		else{
			$coins = $contents;
		}

		 //dd($coins);

		// usort($coins, function($a, $b) {
		// 	return $b['volume'] - $a['volume'];
		// });

		$usdt_prices = [];	

		foreach ($coins as $key => $coin) {
			if(is_array($coin)) {
				$usdt_prices[$key] = $coin["sell_price"] * 0.000915;
			}			
			
		}

		return $usdt_prices;
		
	}

}