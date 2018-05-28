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


Route::get('/binance_old', 'BinanceController@index')->name('binance_old');

Route::get('/binance', 'BinanceController@show')->name('binance');

Route::get('/bithumb', 'BithumbController@index')->name('bithumb');

Route::get('/bittrex', 'BittrexController@index')->name('bittrex');

Route::get('/bitfinex', 'BitfinexController@index')->name('bitfinex');

Route::get('/ethereum', 'EthController@index')->name('ethereum');

//Route::get('/gdax', 'GDaxController@index')->name('gdax');



Route::get('/spread/bithumb', 'SpreadController@bithumb')->name('spread-bithumb');

Route::get('/spread/bittrex', 'SpreadController@bittrex')->name('spread-bittrex');

Route::get('/spread/binance', 'SpreadController@binance')->name('spread-binance');


Route::get('/csv/index', 'CsvController@index')->name('csv-index');

Route::get('/csv/show', 'CsvController@show')->name('csv-show');

Route::post('/csv/upload', 'CsvController@fileUpload')->name('csv-upload');

Route::post('/csv/upload-all', 'CsvController@fileUploadAll')->name('csv-upload-all');

Route::post('/csv/upload-all', 'CsvController@fileUploadAll')->name('csv-upload-all');



Route::get('/post', 'PostController@index')->name('post-index');

Route::get('/post/create', 'PostController@create')->name('post-create');

Route::post('/post', 'PostController@store')->name('post-store');










