@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">      
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#usdt">Show/Hide USDT </button><br>     
      <div id="usdt" class="panel panel-default collapse in">
        <table class="table"  table-striped>
          <thead>
            <tr>
              <th> coin </th>
              <th class="text-right"> Bittrex </th>   
              <th class="text-right"> Bitfinex </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
              <th class="text-right"> Binance </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
            </tr>
          </thead>
          <tbody>
           @foreach($data['USDT'] as $symbol => $coin)
           <tr>
            <td> {{ $symbol }} </td>
            <td class="text-right"> {{ number_format($coin['bittrex'],2) }} $</td>
            @if(isset($coin['bitfinex']))
            <td class="text-right"> {{ number_format($coin['bitfinex'],2) }} $</td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff-perc']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff'] ,2)}} $</td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance']))
            <td class="text-right"> {{ number_format($coin['binance'],2) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff-perc']))
            <td class="text-right" style="color:{{ $coin['binance-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff']))
            <td class="text-right" style="color:{{ $coin['binance-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff'] ,2)}} $</td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
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
              <th> coin </th>
              <th class="text-right"> Bittrex </th>   
              <th class="text-right"> Bitfinex </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
              <th class="text-right"> Binance </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
            </tr>
          </thead>
          <tbody>
           @foreach($data['BTC'] as $symbol => $coin)
           <tr>
            <td> {{ $symbol }} </td>
            <td class="text-right"> {{ number_format($coin['bittrex'],8) }} </td>
            @if(isset($coin['bitfinex']))
            <td class="text-right"> {{ number_format($coin['bitfinex'],8) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff-perc']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff'],8) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance']))
            <td class="text-right"> {{ number_format($coin['binance'],8) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff-perc']))
            <td class="text-right" style="color:{{ $coin['binance-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff']))
            <td class="text-right" style="color:{{ $coin['binance-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff'],8) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
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
              <th> coin </th>
              <th class="text-right"> Bittrex </th>   
              <th class="text-right"> Bitfinex </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
              <th class="text-right"> Binance </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
            </tr>
          </thead>
          <tbody>
           @foreach($data['ETH'] as $symbol => $coin)
           <tr>
            <td> {{ $symbol }} </td>
            <td class="text-right"> {{ number_format($coin['bittrex'],6) }} </td>
            @if(isset($coin['bitfinex']))
            <td class="text-right"> {{ number_format($coin['bitfinex'],6) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff-perc']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bitfinex-diff']))
            <td class="text-right" style="color:{{ $coin['bitfinex-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bitfinex-diff'],6) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance']))
            <td class="text-right"> {{ number_format($coin['binance'],6) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff-perc']))
            <td class="text-right" style="color:{{ $coin['binance-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff-perc'],3) }} % </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff']))
            <td class="text-right" style="color:{{ $coin['binance-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff'],6) }} </td>
            @else
            <td class="text-right" style="color: blue;"> ##### </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>



</div>
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