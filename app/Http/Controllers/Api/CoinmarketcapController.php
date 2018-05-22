<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoinmarketcapModel;

class CoinmarketcapController extends Controller {

    public function getData() {
        $client = new CoinmarketcapModel();

        return $client->getData(); //you can pass limit of data, default is 50
    }

}
