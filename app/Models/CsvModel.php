<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use App\Models\BinanceModel;

/**
 * Description of csvModel
 *
 * @author fluxton
 */
class CsvModel {

    /**
     * receives full array data of history from binance and elaborates the data .
     *
     * @return [$btc_usd_rate, $btc_coins]
     */
    public function elaborateBinanceAllHistory($data_array) {

        $binance_model = new BinanceModel();

        $binance_prices = $binance_model->getBinancePricesBySymbol();

        //dd($binance_prices);

        $prices = [];

        foreach ($data_array as $row) {
            list($symbol, $market) = $binance_model->getCoinSymbolMarket($row[1]);

            $values = $this->evalueSingleTransaction($row);

            if (!array_key_exists($symbol, $prices)) {
                $prices[$symbol] = [];
            }

            if (!array_key_exists($market, $prices[$symbol])) {
                $prices[$symbol][$market] = $values;
            } else {
                $prices[$symbol][$market]['balance'] += $values['balance'];
                $prices[$symbol][$market]['amount'] += $values['amount'];
                $prices[$symbol][$market]['fees'] += $values['fees'];
            }


//            $prices[$symbol][$market]['total_coin_value'] = $prices[$symbol][$market]['amount'] * $prices[$symbol][$market]['exchange_price'];
//            $prices[$symbol][$market]['gain_loss'] = $prices[$symbol][$market]['balance'] + $prices[$symbol][$market]['total_coin_value'];
//            $perc = $prices[$symbol][$market]['price_change_percent'] / 100;
//            $prices[$symbol][$market]['diff_24h'] = $prices[$symbol][$market]['total_coin_value'] * ($perc / (1 + $perc));
        }

        list($total_data, $total_usdt) = $this->evalueTotalData($prices, $binance_prices);

        return [$prices, $total_data, $total_usdt];
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
//            'avg_cost' => 0,
//            'exchange_price' => 0,
//            'price_change_percent' => 0,
//            'total_coin_value' => 0,
//            'gain_loss' => 0,
//            'diff_24h' => 0,
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

    public function evalueTotalData(&$prices, $binance_prices) {

        $total_data = [];


        foreach ($prices as $symbol => &$symbol_market) {
            foreach ($symbol_market as $market => &$value) {
                $value['avg_cost'] = -$value['balance'] / $value['amount'];
                $value['exchange_price'] = $binance_prices[$symbol][$market]['price'];
                $value['price_change_percent'] = $binance_prices[$symbol][$market]['price_change_percent'];
                $value['total_coin_value'] = $value['exchange_price'] * $value['amount'];
                $value['gain_loss'] = $value['balance'] + $value['total_coin_value'];
                $value['diff_24h'] = $binance_prices[$symbol][$market]['priceChange'] * $value['amount'];


                if (!isset($total_data[$market])) {
                    $total_data[$market] = [
                        'gain_loss' => 0,
                        'diff_24h' => 0,
                        'gain_loss_usdt' => 0,
                        'diff_24h_usdt' => 0,
                    ];
                }

                $total_data[$market]['gain_loss'] += $value['gain_loss'];
                $total_data[$market]['diff_24h'] += $value['diff_24h'];
            }
        }

        $total_usdt = [
            'gain_loss' => 0,
            'diff_24h' => 0,
        ];

        //dd($prices);

        foreach ($total_data as $market_name => &$market) {
            if ($market_name == 'USDT') {
                $rate = 1;
            } else {
                $rate = $binance_prices[$market_name]['USDT']['price'];
            }

            $market['gain_loss_usdt'] = $market['gain_loss'] * $rate;
            $market['diff_24h_usdt'] = $market['diff_24h'] * $rate;

            $total_usdt['gain_loss'] += $market['gain_loss_usdt'];
            $total_usdt['diff_24h'] += $market['diff_24h_usdt'];
        }




        //dd($total_usdt);

        return [$total_data, $total_usdt];
    }

}
