@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 text-center">
        <p class="text-center">Price Updated at: <span id="start_time"></span> , current time : <span id="time"></span></p>   
        <button id="update_button" type="button" class="btn btn-primary">Update Data</button>
      </div>
    </div>
    <br>
    
    
    
  <div class="row">
    <div class="col-md-10">     
        
        @foreach($coins as $market_symbol => $market_coins)
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$market_symbol}}">Show/Hide {{$market_symbol}} </button><br>     
      <div id="{{$market_symbol}}" class="panel panel-default collapse in">
        <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> # </th>
              <th> symbol </th>
              <th class="text-center"> price </th>   
              <th class="text-center"> % 24h </th>
              <th class="text-center"> price diff (24h) </th>
              <th class="text-center"> day highest </th>
              <th class="text-center"> day lowest </th>
              <th class="text-center"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($market_coins as $index => $coin)
           <tr>
            <td> {{ $index+1 }} </td>
            <td> {{ $coin['symbol'] }} </td>
            <td class="text-right" data-value="{{ $coin['lastPrice'] }}"> {{ $coin['lastPrice'] }}</td>
            <td class="text-right" data-value="{{ $coin['priceChangePercent'] }}" style="color:{{ $coin['priceChangePercent'] < 0 ? " red" : " green"  }} ;"> {{ $coin['priceChangePercent'] }} % </td>
            <td class="text-right" data-value="{{ $coin['priceChange'] }}" style="color:{{ $coin['priceChange'] < 0 ? " red" : " green"  }} ;"> {{ $coin['priceChange'] }} $</td>
            <td class="text-right" data-value="{{ $coin['highPrice'] }}"> {{ $coin['highPrice'] }}</td>
            <td class="text-right" data-value="{{ $coin['lowPrice'] }}"> {{ $coin['lowPrice'] }}</td>
            <td class="text-right"> {{ $coin['quoteVolume'] }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    

    <br><hr><br>
    
    @endforeach

  </div>
</div>



</div>




@include('layouts.datatable-layout')
  {{-- @include('scripts.binance') --}}
  <script type="text/javascript" src="{{  asset('/asset/js/binance.js') }}"></script>


@endsection

{{--  "symbol" => "BTC"
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