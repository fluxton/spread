@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Coin Market Cap Info</div>                

                <table class="table"  table-striped>
                    <thead>
                        <tr>
                            <th> rank </th>
                            <th> name </th>
                            <th class="text-right"> usd </th>
                            <th class="text-right"> btc</th>
                            <th class="text-right"> market cap </th>
                            <th class="text-right"> volume(24h) </th>
                            <th class="text-right"> % 1h </th>
                            <th class="text-right"> % 24h </th>
                            <th class="text-right"> % 7d </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($coins as $coin)
                       <tr>
                          <th scope="row"> {{ $coin['rank'] }} </td>
                              <td> {{ $coin['name'] }} </td>
                              <td class="text-right"> {{ $coin['price_usd'] }} </td>
                              <td class="text-right"> {{ $coin['price_btc'] }} </td>
                              <td class="text-right"> {{ intval($coin['market_cap_usd']) }} </td>
                              <td class="text-right"> {{ intval($coin['24h_volume_usd']) }} </td>
                              <td class="text-right" style="color:{{ $coin['percent_change_1h'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_1h'] }} </td>
                              <td class="text-right" style="color:{{ $coin['percent_change_24h'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_24h'] }} </td>
                              <td class="text-right" style="color:{{ $coin['percent_change_7d'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_7d'] }} </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>

              </div>
          </div>
      </div>



  </div>
  @endsection


{{-- {
"id": "bitcoin",
"name": "Bitcoin",
"symbol": "BTC",
"rank": "1",
"price_usd": "11017.7",
"price_btc": "1.0",
"24h_volume_usd": "6688800000.0",
"market_cap_usd": "185484356712",
"available_supply": "16835125.0",
"total_supply": "16835125.0",
"max_supply": "21000000.0",
"percent_change_1h": "0.26",
"percent_change_24h": "-2.71",
"percent_change_7d": "4.44",
"last_updated": "1517310268"
} --}}