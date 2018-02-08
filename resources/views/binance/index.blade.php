@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">      
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#usdt">Show/Hide USDT </button><br>     
      <div id="usdt" class="panel panel-default collapse in">
        <table id="ordering" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-right"> usd </th>   
              <th class="text-right"> % 24h </th>
              <th class="text-right"> price diff (24h) </th>
              <th class="text-right"> day highest </th>
              <th class="text-right"> day lowest </th>
              <th class="text-right"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($usdt_coins as $usdt_coin)
           <tr>
            <td> {{ $usdt_coin['symbol'] }} </td>
            <td class="text-right"> {{ number_format($usdt_coin['lastPrice'],2) }} $</td>
            <td class="text-right" style="color:{{ $usdt_coin['priceChangePercent'] < 0 ? " red" : " green"  }} ;"> {{ $usdt_coin['priceChangePercent'] }} % </td>
            <td class="text-right" style="color:{{ $usdt_coin['priceChange'] < 0 ? " red" : " green"  }} ;"> {{ number_format($usdt_coin['priceChange'] ,2)}} $</td>
            <td class="text-right"> {{ number_format($usdt_coin['highPrice'],2) }} </td>
            <td class="text-right"> {{ number_format($usdt_coin['lowPrice'],2) }} </td>
            <td class="text-right"> {{ number_format($usdt_coin['quoteVolume'],2) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    

    <br><hr><br>

    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#btc">Show/Hide BTC </button><br>     
      <div id="btc" class="panel panel-default collapse in">
        <table class="table"  table-striped>
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-right"> Bitcoin </th>   
              <th class="text-right"> % 24h </th>
              <th class="text-right"> price diff (24h) </th>
              <th class="text-right"> day highest </th>
              <th class="text-right"> day lowest </th>
              <th class="text-right"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($btc_coins as $btc_coin)
           <tr>
            <td> {{ $btc_coin['symbol'] }} </td>
            <td class="text-right"> {{ $btc_coin['lastPrice'] }} </td>
            <td class="text-right" style="color:{{ $btc_coin['priceChangePercent'] < 0 ? " red" : " green"  }} ;"> {{ $btc_coin['priceChangePercent'] }} % </td>
            <td class="text-right" style="color:{{ $btc_coin['priceChange'] < 0 ? " red" : " green"  }} ;"> {{ $btc_coin['priceChange'] }} </td>
            <td class="text-right"> {{ $btc_coin['highPrice'] }} </td>
            <td class="text-right"> {{ $btc_coin['lowPrice'] }} </td>
            <td class="text-right"> {{ $btc_coin['quoteVolume'] }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    

    <br><hr><br>

    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#eth">Show/Hide ETH </button><br>     
      <div id="eth" class="panel panel-default collapse in">
        <table class="table"  table-striped>
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-right"> Ethereum </th>   
              <th class="text-right"> % 24h </th>
              <th class="text-right"> price diff (24h) </th>
              <th class="text-right"> day highest </th>
              <th class="text-right"> day lowest </th>
              <th class="text-right"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($eth_coins as $eth_coin)
           <tr>
            <td> {{ $eth_coin['symbol'] }} </td>
            <td class="text-right"> {{ $eth_coin['lastPrice'] }} </td>
            <td class="text-right" style="color:{{ $eth_coin['priceChangePercent'] < 0 ? " red" : " green"  }} ;"> {{ $eth_coin['priceChangePercent'] }} % </td>
            <td class="text-right" style="color:{{ $eth_coin['priceChange'] < 0 ? " red" : " green"  }} ;"> {{ $eth_coin['priceChange'] }} </td>
            <td class="text-right"> {{ $eth_coin['highPrice'] }} </td>
            <td class="text-right"> {{ $eth_coin['lowPrice'] }} </td>
            <td class="text-right"> {{ $eth_coin['quoteVolume'] }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>



</div>




@include('layouts.datatable-layout')

<script>
$(document).ready(function() {
    $('#ordering').DataTable();
} );
</script>



@endsection

{{--  "symbol" => "BTCUSDT"
    "priceChange" => "-900.00000000"
    "priceChangePercent" => "-8.086"
    "weightedAvgPrice" => "10278.53557147"
    "prevClosePrice" => "11138.98000000"
    "lastPrice" => "10230.01000000"
    "lastQty" => "0.00484500"
    "bidPrice" => "10230.01000000"
    "bidQty" => "0.08212800"
    "askPrice" => "10240.99000000"
    "askQty" => "1.00000000"
    "openPrice" => "11130.01000000"
    "highPrice" => "11160.03000000"
    "lowPrice" => "9700.00000000"
    "volume" => "30482.24556000"
    "quoteVolume" => "313312845.28667789"
    "openTime" => 1517303174869
    "closeTime" => 1517389574869
    "firstId" => 11077801
    "lastId" => 11383676
    "count" => 305876 --}}