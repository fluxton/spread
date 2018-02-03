@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Coin Market Cap Info</div>                

               <table class="table"  table-striped>
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-right"> usd </th> 
              <th class="text-right"> day highest </th>
              <th class="text-right"> day lowest </th>
              <th class="text-right"> volume ($) </th>
            </tr>
          </thead>
          <tbody>
           @foreach($coins as $symbol => $coin)
           <tr>
            <td> {{ $symbol }} </td>
            <td class="text-right"> {{ $coin['sell_price'] }} </td>
            <td class="text-right"> {{ $coin['max_price'] }} </td>
            <td class="text-right"> {{ $coin['min_price'] }} </td>
            <td class="text-right"> {{ intval($coin['volume_1day']*$coin['sell_price']*1063.83) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>

              </div>
          </div>
      </div>



  </div>
  @endsection


{{-- "BTC": {
"opening_price": "12590000",
"closing_price": "11441000",
"min_price": "10555000",
"max_price": "12650000",
"average_price": "11650106.2946",
"units_traded": "12120.66110718",
"volume_1day": "12120.66110718",
"volume_7day": "79819.19231880",
"buy_price": "11440000",
"sell_price": "11441000"
}, --}}