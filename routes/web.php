<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/coinmarketcap', 'CoinmarketcapController@index')->name('coinmarketcap');


Route::get('/binance', 'BinanceController@index')->name('binance');

Route::get('/bithumb', 'BithumbController@index')->name('bithumb');

Route::get('/bittrex', 'BittrexController@index')->name('bittrex');

Route::get('/bitfinex', 'BitfinexController@index')->name('bitfinex');

Route::get('/ethereum', 'EthController@index')->name('ethereum');

Route::get('/spread/bithumb', 'SpreadController@bithumb')->name('spread-bithumb');

Route::get('/spread/bittrex', 'SpreadController@bittrex')->name('spread-bittrex');

Route::get('/spread/binance', 'SpreadController@binance')->name('spread-binance');



