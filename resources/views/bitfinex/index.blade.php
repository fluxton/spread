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
            <td> {{ $usdt_coin['symbol'] }} </td>
            <td class="text-right" data-value="{{ $usdt_coin['last_price'] }}"> {{ number_format($usdt_coin['last_price'],4) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['daily_change_perc'] }}" style="color:{{ $usdt_coin['daily_change_perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($usdt_coin['daily_change_perc'],4) }} % </td>
            <td class="text-right" data-value="{{ $usdt_coin['daily_change'] }}" style="color:{{ $usdt_coin['daily_change'] < 0 ? " red" : " green"  }} ;"> {{ number_format($usdt_coin['daily_change'] ,2)}} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['high'] }}"> {{ number_format($usdt_coin['high'],4) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['low'] }}"> {{ number_format($usdt_coin['low'],4) }} $</td>
            <td class="text-right" data-value="{{ $usdt_coin['volume'] }}"> {{ number_format($usdt_coin['volume'],2) }} </td>
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
            <td> {{ $btc_coin['symbol'] }} </td>
            <td class="text-right"> {{ number_format($btc_coin['last_price'],8) }} </td>
            <td class="text-right" data-value="{{ $btc_coin['daily_change_perc'] }}" style="color:{{ $btc_coin['daily_change_perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($btc_coin['daily_change_perc'],3) }} % </td>
            <td class="text-right" style="color:{{ $btc_coin['daily_change'] < 0 ? " red" : " green"  }} ;"> {{ number_format($btc_coin['daily_change'] ,8) }} </td>
            <td class="text-right"> {{ number_format($btc_coin['high'],8) }} </td>
            <td class="text-right"> {{ number_format($btc_coin['low'],8) }} </td>
            <td class="text-right" data-value="{{ $btc_coin['volume'] }}"> {{ number_format($btc_coin['volume'],2) }} </td>
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
            <td> {{ $eth_coin['symbol'] }} </td>
            <td class="text-right"> {{ number_format($eth_coin['last_price'],8) }} </td>
            <td class="text-right" data-value="{{ $eth_coin['daily_change_perc'] }}" style="color:{{ $eth_coin['daily_change_perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($eth_coin['daily_change_perc'],3) }} % </td>
            <td class="text-right" style="color:{{ $eth_coin['daily_change'] < 0 ? " red" : " green"  }} ;"> {{ number_format($eth_coin['daily_change'] ,8) }} </td>
            <td class="text-right"> {{ number_format($eth_coin['high'],8) }} </td>
            <td class="text-right"> {{ number_format($eth_coin['low'],8) }} </td>
            <td class="text-right" data-value="{{ $eth_coin['volume'] }}"> {{ number_format($eth_coin['volume'],2) }} </td>
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
"symbol" => substr($coin[0], 1),
//"bid" => $coin[1],
//"bid_size" => $coin[2],
//"ask" => $coin[3],
//"ask_size" => $coin[4],
"daily_change" => $coin[5],
"daily_change_perc" => $coin[6],
"last_price" => $coin[7],
"volume" => $coin[8],       
"high" => $coin[9],
"low" => $coin[10]
// } --}}