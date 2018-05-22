<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use GuzzleHttp\Client;

/**
 * Description of CoinmarketcapModel
 *
 * @author fluxton
 */
class CoinmarketcapModel {

    protected $api_client;

    public function __construct() {
        $this->api_client = new Client(['base_uri' => 'https://api.coinmarketcap.com/v1/ticker/']);
        // $client = new Client([
        // 	// Base URI is used with relative requests
        // 	'base_uri' => 'https://api.coinmarketcap.com/v1/ticker/',
        // 	// You can set any number of default request options.
        // 	'timeout'  => 2.0,
        // ]);
    }

    public function getData($limit = 50) {
        $response = $this->api_client->request('GET', "?limit=$limit");

        return $response->getBody(true)->getContents();


        // $contents = json_decode($response->getBody(true)->getContents(),true);
        //    return json_encode(
        //        'data' => [
        //            'coins' => $contents
        //        ],
        //        'message' => 'ok'
        //        );
    }

}
