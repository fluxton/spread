<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use GuzzleHttp\Client;

/**
 * Description of GDax
 *
 * @author fluxton
 */
class GDax {
    protected $base_url = 'https://api.gdax.com/';
    
    
    public function getBtcUsd(){
        $client = new Client(['base_uri' => 'https://api.gdax.com/']);

        $response = $client->request('GET', 'products/btc-usd/ticker');

        return json_decode($response->getBody(true)->getContents(), true);
    }
    
    public function getEthUsd(){
        $client = new Client(['base_uri' => 'https://api.gdax.com/']);

        $response = $client->request('GET', 'products/eth-usd/ticker');

        return json_decode($response->getBody(true)->getContents(), true);
    }
    
    public function getLtcUsd(){
        $client = new Client(['base_uri' => 'https://api.gdax.com/']);

        $response = $client->request('GET', 'products/ltc-usd/ticker');

        return json_decode($response->getBody(true)->getContents(), true);
    }
    
    public function getBchUsd(){
        $client = new Client(['base_uri' => 'https://api.gdax.com/']);

        $response = $client->request('GET', 'products/bch-usd/ticker');

        return json_decode($response->getBody(true)->getContents(), true);
    }
}
