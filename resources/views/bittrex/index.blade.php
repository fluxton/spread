@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#usdt">Show/Hide USDT </button><br>     
      <div id="usdt" class="panel panel-default collapse in">
        <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-center"> usd </th>   
              <th class="text-center"> % 24h </th>
              <th class="text-center"> price diff (24h) </th>
              <th class="text-center"> day highest </th>
              <th class="text-center"> day lowest </th>
              <th class="text-center"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($usdt_coins as $usdt_coin)
           <tr>
            <td> {{ $usdt_coin['MarketName'] }} </td>
            <td class="text-right" data-value="{{ $usdt_coin['Last'] }}"> {{ number_format($usdt_coin['Last'],2) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['ChangePercent24h'] }}" style="color:{{ $usdt_coin['ChangePercent24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($usdt_coin['ChangePercent24h'],3) }} % </td>
            <td class="text-right" data-value="{{ $usdt_coin['Change24h'] }}" style="color:{{ $usdt_coin['Change24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($usdt_coin['Change24h'] ,2)}} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['High'] }}"> {{ number_format($usdt_coin['High'],2) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['Low'] }}"> {{ number_format($usdt_coin['Low'],2) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['BaseVolume'] }}"> {{ number_format($usdt_coin['BaseVolume'],2) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <br><hr><br>

    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#btc">Show/Hide BTC </button><br>     
      <div id="btc" class="panel panel-default collapse in">
        <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-center"> Bitcoin </th>   
              <th class="text-center"> % 24h </th>
              <th class="text-center"> price diff (24h) </th>
              <th class="text-center"> day highest </th>
              <th class="text-center"> day lowest </th>
              <th class="text-center"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($btc_coins as $btc_coin)
           <tr>
            <td> {{ $btc_coin['MarketName'] }} </td>
            <td class="text-right"> {{ number_format($btc_coin['Last'],8) }} </td>
            <td class="text-right" data-value="{{ $btc_coin['ChangePercent24h'] }}" style="color:{{ $btc_coin['ChangePercent24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($btc_coin['ChangePercent24h'],3) }} % </td>
            <td class="text-right" style="color:{{ $btc_coin['Change24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($btc_coin['Change24h'] ,8) }} </td>
            <td class="text-right"> {{ number_format($btc_coin['High'],8) }} </td>
            <td class="text-right"> {{ number_format($btc_coin['Low'],8) }} </td>
            <td class="text-right" data-value="{{ $btc_coin['BaseVolume'] }}"> {{ number_format($btc_coin['BaseVolume'],2) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <br><hr><br>

    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#eth">Show/Hide ETH </button><br>     
      <div id="eth" class="panel panel-default collapse in">
        <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-center"> Ethereum </th>   
              <th class="text-center"> % 24h </th>
              <th class="text-center"> price diff (24h) </th>
              <th class="text-center"> day highest </th>
              <th class="text-center"> day lowest </th>
              <th class="text-center"> volume </th>
            </tr>
          </thead>
          <tbody>
           @foreach($eth_coins as $eth_coin)
           <tr>
            <td> {{ $eth_coin['MarketName'] }} </td>
            <td class="text-right"> {{ number_format($eth_coin['Last'],8) }} </td>
            <td class="text-right" data-value="{{ $eth_coin['ChangePercent24h'] }}" style="color:{{ $eth_coin['ChangePercent24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($eth_coin['ChangePercent24h'],3) }} % </td>
            <td class="text-right" style="color:{{ $eth_coin['Change24h'] < 0 ? " red" : " green"  }} ;"> {{ number_format($eth_coin['Change24h'] ,8) }} </td>
            <td class="text-right"> {{ number_format($eth_coin['High'],8) }} </td>
            <td class="text-right"> {{ number_format($eth_coin['Low'],8) }} </td>
            <td class="text-right" data-value="{{ $eth_coin['BaseVolume'] }}"> {{ number_format($eth_coin['BaseVolume'],2) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>


  </div>
</div>



</div>
@include('layouts.datatable-layout')
@endsection

{{-- //    {
// "MarketName": "USDT-ADA",
// "High": 0.52180897,
// "Low": 0.47000001,
// "Volume": 3973860.78129699,
// "Last": 0.51335656,
// "BaseVolume": 1969692.29553585,
// "TimeStamp": "2018-02-01T03:25:56.603",
// "Bid": 0.51068,
// "Ask": 0.51335656,
// "OpenBuyOrders": 888,
// "OpenSellOrders": 4699,
// "PrevDay": 0.49508427,
// "Created": "2017-12-29T19:24:39.987"
// } --}}