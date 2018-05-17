@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 text-center">
            <p class="text-center"><button id="update_button" type="button" class="btn btn-primary">Update Data</button>  Last Updated at: <span id="start_time"></span></p>   
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="auto_update">
                <label class="form-check-label" for="auto_update">Auto update the table with fresh data every 1 minute</label>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Coin Market Cap Info</div>                

                <table class="table table-striped table-bordered sortable">
                    <thead>
                        <tr>
                            <th> rank </th>
                            <th> name </th>
                            <th class="text-center"> usd </th>
                            <th class="text-center"> btc</th>
                            <th class="text-center"> market cap </th>
                            <th class="text-center"> volume(24h) </th>
                            <th class="text-center"> % 1h </th>
                            <th class="text-center"> % 24h </th>
                            <th class="text-center"> % 7d </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coins as $coin)
                        <tr>
                            <td id="{{ $coin['symbol'] }}_rank" data-value="{{ $coin['rank'] }}"> {{ $coin['rank'] }} </td>
                            <td id="{{ $coin['symbol'] }}_name" data-value="{{ $coin['name'] }}"> {{ $coin['name'] }} </td>
                            <td id="{{ $coin['symbol'] }}_price_usd" class="text-right" data-value="{{ $coin['price_usd'] }}">$ {{ number_format($coin['price_usd'],2, '.', ',') }}  $</td>
                            <td id="{{ $coin['symbol'] }}_price_btc" class="text-right" data-value="{{ $coin['price_btc'] }}"> {{ $coin['price_btc'] }} </td>
                            <td id="{{ $coin['symbol'] }}_market_cap_usd" class="text-right" data-value="{{ $coin['market_cap_usd'] }}"> {{ intval($coin['market_cap_usd']) }} $</td>
                            <td id="{{ $coin['symbol'] }}_24h_volume_usd" class="text-right" data-value="{{ $coin['24h_volume_usd'] }}"> {{ intval($coin['24h_volume_usd']) }} $</td>
                            <td id="{{ $coin['symbol'] }}_percent_change_1h" class="text-right"  data-value="{{ $coin['percent_change_1h'] }}"style="color:{{ $coin['percent_change_1h'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_1h'] }} </td>
                            <td id="{{ $coin['symbol'] }}_percent_change_24h" class="text-right"  data-value="{{ $coin['percent_change_24h'] }}"style="color:{{ $coin['percent_change_24h'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_24h'] }} </td>
                            <td id="{{ $coin['symbol'] }}_percent_change_7d" class="text-right"  data-value="{{ $coin['percent_change_7d'] }}"style="color:{{ $coin['percent_change_7d'] < 0 ? " red" : " green"  }} ;"> {{ $coin['percent_change_7d'] }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
@include('layouts.datatable-layout')
<script type="text/javascript" src="{{  asset('/js/coinmarketcap.js') }}"></script>
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