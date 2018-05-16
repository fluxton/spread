<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Binance;


class CsvController extends Controller {
    
    protected $binance;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->binance = new Binance();
    }

    /**
     * Show the page to upload a csv file.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('csv.index');
    }

    public function show() {
        return view('csv.show');
    }

    public function upload() {
        return view('csv.index');
    }

    public function fileUpload(Request $request) {
        
        $csv_file = $request->file('csv_file');     //TODO add error handler if file missing or broken

        $data_array = $this->readCSV($csv_file);
//
//
//        $data_array = array_filter($data_array, function($elem) {
//            return is_array($elem);
//        });
        
        //$coins_array = $this->binance->readCSVtoArray($csv_file);

        //dd($data_array);



        $data_keys = array_shift($data_array);

        $market_key = array_search("Market", $data_keys);    //1
        $type_key = array_search("Type", $data_keys);  //2

        $amount_key = array_search("Amount", $data_keys);       //4        
        $total_price_key = array_search("Total", $data_keys);   //5
        $fee_key = array_search("Fee", $data_keys);             //6    	
        $fee_coin_key = array_search("Fee Coin", $data_keys);   //7

        $total_price = 0;
        $total_fee = 0;
        $total_amount = 0;

        $coins = [];



        foreach ($data_array as $index => $row) {

            //if(strcasecmp($row[$fee_coin_key],"bnb") != 0 ) continue;

            if (strcasecmp($row[$type_key], "buy") == 0) {
                $data_array[$index][$total_price_key] = -abs($row[$total_price_key]);
                $data_array[$index][$amount_key] = +abs($row[$amount_key]);
                $total_price -= abs($row[$total_price_key]);
                $total_amount += $row[$amount_key];
            } else if (strcasecmp($row[$type_key], "sell") == 0) {
                $data_array[$index][$total_price_key] = +abs($row[$total_price_key]);
                $data_array[$index][$amount_key] = -abs($row[$amount_key]);
                $total_price += abs($row[$total_price_key]);
                $total_amount -= $row[$amount_key];
            } else {
                unset($data_array[$index]);
            }
            //$total_price += $data_array[$index][$total_price_key];
            $total_fee += $row[$fee_key];
        }
        //$last_index = count($data_array);

        $average_result = 0;

        if ($total_amount != 0) {
            $average_result = -$total_price / $total_amount;
        }

        $results_array = [
            'Balance $' => $total_price,
            'coin difference' => $total_amount,
            'Price to buy/sell to go even' => $average_result,
            'Total Fees paid' => $total_fee,
        ];

        //dd($data_array);

        return view('csv.index', [
            'data_array' => $data_array,
            'results_array' => $results_array,
            'data_keys' => $data_keys,
        ]);
    }

    public function fileUploadAll(Request $request) {
        $csv_file = $request->file('csv_file');
        
        $data_array = $this->readCSVtoArray($csv_file);

        $data_keys = array_shift($data_array);
        
        $binance_model = new Binance();
        
        list($coins,$total_balance, $total_usdt) = $binance_model->elaborateBinanceAllHistory($data_array);

        return view('csv.show', [
            'coins' => $coins,
            'total_balance' => $total_balance,
            'total_usdt' => $total_usdt,
        ]);
    }

    protected function readCSVtoArray($csvFile) {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        
        $result = array_filter($line_of_text, function($var) {
            return is_array($var);
        });
        
        return $result;
    }

}
