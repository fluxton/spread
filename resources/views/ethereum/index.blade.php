@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div id="usdt" class="panel panel-default">
        <table class="table"  table-striped>
          <thead>
            <tr>
              <th> market </th>
              <th class="text-right"> Binance </th>   
              <th class="text-right"> Bitfinex </th>
              <th class="text-right"> Bittrex </th>
              <th class="text-right"> Bithumb </th>
            </tr>
          </thead>
          <tbody>

           <tr>
            <td> USD $ </td>
            <td class="text-right"> {{ number_format($usdt_binance,2) }} $</td>
            <td class="text-right"> {{ number_format($usdt_bitfinex,2) }} $</td>
            <td class="text-right"> {{ number_format($usdt_bittrex,2) }} $</td>
            <td class="text-right"> {{ number_format($usd_bithumb,2) }} $</td>
          </tr>

          <tr>
            <td> BTC </td>
            <td class="text-right"> {{ number_format($btc_binance,8) }} </td>
            <td class="text-right"> {{ number_format($btc_bitfinex,8) }} </td>
            <td class="text-right"> {{ number_format($btc_bittrex,8) }} </td>
            <td class="text-right"> ##### </td>
          </tr>
          
        </tbody>
      </table>
    </div>


  </div>
</div>



</div>
@endsection


{{-- 'usdt_bittrex' => $usdt_bittrex,
'btc_bittrex' => $btc_bittrex,
'usdt_binance' => $usdt_binance,
'btc_binance' => $btc_binance,
'usdt_bitfinex' => $usdt_bitfinex,
'btc_bitfinex' => $btc_bitfinex,
'krw_bithumb' => $krw_bithumb,
'usd_bithumb' => $usd_bithumb, --}}