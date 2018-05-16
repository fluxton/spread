<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use GuzzleHttp\Client;

/**
 * Description of Binance
 *
 * @author fluxton
 */
class Binance {

    /**
     * receives full array data of history from binance and elaborates the data .
     *
     * @return [$btc_usd_rate, $btc_coins]
     */
    public function elaborateBinanceAllHistory($data_array) {

        $binance_prices = $this->getBinancePrices();

        $prices = [];

        foreach ($data_array as $row) {
            list($symbol, $market) = $this->getCoinSymbolMarket($row[1]);

            $values = $this->evalueSingleTransaction($row);

            if (!array_key_exists($symbol, $prices)) {
                $prices[$symbol] = [];
            }

            if (!array_key_exists($market, $prices[$symbol])) {
                $prices[$symbol][$market] = [
                    'balance' => 0,
                    'amount' => 0,
                    'fees' => 0,
                    'total_coin_value' => 0,
                    'exchange_price' => $binance_prices[$symbol][$market]['price'],
                    'price_change_percent' => $binance_prices[$symbol][$market]['price_change_percent'],
                    'gain_loss' => 0,
                    'diff_24h' => 0,
                ];
            }

            //echo "coin: " . $symbol . ", market: " . $symbol . "<br><br>";
            //echo "transaction values: ";            var_dump($values);      echo "<br><br>";


            $prices[$symbol][$market]['balance'] += $values['balance'];
            $prices[$symbol][$market]['amount'] += $values['amount'];
            $prices[$symbol][$market]['fees'] += $values['fees'];
            $prices[$symbol][$market]['total_coin_value'] = $prices[$symbol][$market]['amount'] * $prices[$symbol][$market]['exchange_price'];
            $prices[$symbol][$market]['gain_loss'] = $prices[$symbol][$market]['balance'] + $prices[$symbol][$market]['total_coin_value'];
            $perc = $prices[$symbol][$market]['price_change_percent'] / 100;
            //echo "perc 24h: " .  $perc .  "<br>";
            $prices[$symbol][$market]['diff_24h'] = $prices[$symbol][$market]['total_coin_value'] * ($perc / (1 + $perc));

            //echo "prices values: ";            var_dump($prices[$symbol][$market]);      echo "<br><br>------------------------<br>";
        }

        //die();

        list($total_data,$total_usdt) = $this->evalueTotalData($prices, $binance_prices);
        
        //dd($total_usdt);

        return [$prices, $total_data, $total_usdt];
    }

    /**
     * Get all coins data in usdt markets from binance api.
     *
     * @return [$btc_usd_rate, $btc_coins]
     */
    public function getBinancePrices() {
        $client = new Client(['base_uri' => 'https://api.binance.com/api/v1/ticker/']);

        $response = $client->request('GET', '24hr');

        $coins = json_decode($response->getBody(true)->getContents(), true);

        $prices = [];

        foreach ($coins as $coin) {
            list($symbol, $market) = $this->getCoinSymbolMarket($coin['symbol']);

            if (!array_key_exists($symbol, $prices)) {
                $prices[$symbol] = [];
            }

            if (!array_key_exists($market, $prices[$symbol])) {
                $prices[$symbol][$market] = [];
            }

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

    /**
     * read the row of the array from csv  and elaborate to values: balance (diff of coin used in the transaction, amount(diff of coins after transaction) and fees.
     *
     * @return [$symbol, $market]
     */
    public function evalueSingleTransaction($row) {

//        // 0 => "Date"
//        // 1 => "Market"
//        // 2 => "Type"
//        // 3 => "Price"
//        // 4 => "Amount"
//        // 5 => "Total"
//        // 6 => "Fee"
//        // 7 => "Fee Coin"
        $values = [
            'balance' => 0,
            'amount' => 0,
            'fees' => 0,
        ];

        //var_dump($row);

        $is_buy = (strcasecmp($row[2], "buy") == 0);

        $multiplier = $is_buy ? 1 : -1;

        $values['balance'] = -$multiplier * abs($row[5]);
        $values['amount'] = $multiplier * abs($row[4]);

        $fees = -floatval($row[6]);

        if ($row[7] === 'BNB') {
            $values['fees'] += $fees;
        } else if ($is_buy) {
            $values['amount'] += $fees;
        } else {
            $values['balance'] += $fees;
        }

        return $values;
    }

    public function evalueTotalData($prices, $binance_prices) {

        $total_data = [];


        foreach ($prices as $markets) {
            foreach ($markets as $market => &$value) {
                if($market == 'USDT'){
                    $rate = 1;
                }
                else{
                    $rate = $binance_prices[$market]['USDT']['price'];
                }
                
                
                if (!isset($total_data[$market])) {
                    $total_data[$market] = [
                        'gain_loss' => 0,
                        //'yesterday' => 0,
                        'diff_24h' => 0,
                        'gain_loss_usdt' => 0,
                        'diff_24h_usdt' => 0,
                            //'perc' => 0,
                    ];
                }

                $total_data[$market]['gain_loss'] += $value['gain_loss'];
                $total_data[$market]['diff_24h'] += $value['diff_24h'];
                $total_data[$market]['gain_loss_usdt'] = $total_data[$market]['gain_loss'] * $rate;
                $total_data[$market]['diff_24h_usdt'] = $total_data[$market]['diff_24h'] * $rate;
                //$total_data[$martket]['yesterday'] = $total_data[$martket]['gain_loss'] - $total_data[$martket]['diff_24h'];
            }
        }
        
        
        $total_usdt = [
            'gain_loss' => 0,
            //'yesterday' => 0,
            'diff_24h' => 0,
                //'perc' => 0,
        ];
        

        foreach ($total_data as $market) {
            $total_usdt['gain_loss'] += $market['gain_loss_usdt'];
            $total_usdt['diff_24h'] += $market['diff_24h_usdt'];
        }
        
        //dd($total_usdt);

        return [$total_data,$total_usdt];
    }

}
