<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use GuzzleHttp\Client;

/**
 * Description of BinanceModel
 *
 * @author fluxton
 */
class BinanceModel {

    protected $api_client;

    public function __construct() {
        $this->api_client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);
    }

    /**
     * Get all coins data from binance api.
     *
     * @return [$coins]
     */
    public function getBinancePrices() {
        $response = $this->api_client->request('GET', '24hr');

        return json_decode($response->getBody(true)->getContents(), true);
    }

    /**
     * Get all coins data from binance api organized by symbols and markets.
     *
     * @return [$symbol][$market]
     */
    public function getBinancePricesByMarket() {
        $coins = $this->getBinancePrices();

        $prices = [];

        foreach ($coins as $coin) {
            list($symbol, $market) = $this->getCoinSymbolMarket($coin['symbol']);
            
            $coin['symbol'] = $symbol;

            if (!array_key_exists($market, $prices)) {
                $prices[$market] = [];
            }

            if (!array_key_exists($symbol, $prices[$market])) {
                $prices[$market][$symbol] = [];
            }

            $prices[$market][$symbol] = $coin;
        }
        
        //dd($prices);

        foreach ($prices as &$markt) {
            
            //dd($markt);
            usort($markt, function($a, $b) {
                return $b['quoteVolume'] - $a['quoteVolume'];
            });
            
            //dd($markt);
            
            
        }
        
        //dd($prices);

        return $prices;
    }

    /**
     * Get all coins data from binance api organized by symbols and markets.
     *
     * @return [$symbol][$market]
     */
    public function getBinancePricesBySymbol() {
        $coins = $this->getBinancePrices();

        $prices = [];

        foreach ($coins as $coin) {
            list($symbol, $market) = $this->getCoinSymbolMarket($coin['symbol']);

            if (!array_key_exists($symbol, $prices)) {
                $prices[$symbol] = [];
            }

            if (!array_key_exists($market, $prices[$symbol])) {
                $prices[$symbol][$market] = [];
            }
            
            $prices[$symbol][$market] = $coin;

            $prices[$symbol][$market]['price'] = $coin['lastPrice'];
            $prices[$symbol][$market]['price_change_percent'] = $coin['priceChangePercent'];
        }

        return $prices;
    }

    /**
     * read the string corresponding to the market and the coin and return an array with the 2 elements.
     *
     * @return [$symbol, $market]
     */
    public function getCoinSymbolMarket($string) {

        $strlen = strlen($string);

        if (substr_compare($string, 'USDT', $strlen - 4, 4) === 0) {
            $symbol = substr($string, 0, $strlen - 4);
            $market = 'USDT';
        } else {
            $symbol = substr($string, 0, $strlen - 3);
            $market = substr($string, $strlen - 3, 3);
        }

        if ($symbol === 'BCC') {
            $symbol = 'BCH';
        }

        return [$symbol, $market];
    }

}
