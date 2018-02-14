<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/bithumb/data', 'Api\BithumbController@getData');

Route::get('/binance/data', 'Api\BinanceController@getData');

Route::get('/bitfinex/data', 'Api\BitfinexController@getData');

Route::get('/bittrex/data', 'Api\BittrexController@getData');




Route::get('/bithumb/spread', 'Api\SpreadController@bithumbData');

Route::get('/binance/prices', 'Api\SpreadController@binance');

//Route::get('/bitfinex/prices', 'Api\SpreadController@bitfinex');

Route::get('/bittrex/prices', 'Api\SpreadController@bittrex');



Route::get('/coinmarketcap', 'Api\CoinmarketcapController@getData');
