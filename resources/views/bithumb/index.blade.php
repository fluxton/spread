@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 text-center">
        <p class="text-center">Price Updated at: <span id="start_time"></span> , current time : <span id="time"></span></p>   
        <p class="text-center">Korean Won to US Dollar Exchange rate: <strong id="krw_to_usd">{{ $exchange_rate }}</strong></p>
        <button id="update_button" type="button" class="btn btn-primary">Update Data</button>
      </div>
    </div>
    <br>
      <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                


               <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> symbol </th>
              <th class="text-center"> usd </th> 
              <th class="text-center"> day highest </th>
              <th class="text-center"> day lowest </th>
              <th class="text-center"> volume ($) </th>
            </tr>
          </thead>
          <tbody>
           @foreach($coins as $symbol => $coin)
           <tr id="coin_row_{{ $symbol }}" name="{{ $symbol }}">
            <td > {{ $symbol }} </td>
            <td id="{{ $symbol }}_sell_price" class="text-right" data-value="{{ $coin['sell_price'] }}"> {{ number_format($coin['sell_price']*$exchange_rate,2) }} $</td>
            <td id="{{ $symbol }}_max_price" class="text-right" data-value="{{ $coin['max_price'] }}"> {{ number_format($coin['max_price']*$exchange_rate,2) }} $</td>
            <td id="{{ $symbol }}_min_price" class="text-right" data-value="{{ $coin['min_price'] }}"> {{ number_format($coin['min_price']*$exchange_rate,2) }} $</td>
            <td id="{{ $symbol }}_volume_1day" class="text-right" data-value="{{ $coin['volume_1day']*$coin['sell_price'] }}"> {{ intval($coin['volume_1day']*$coin['sell_price']*0.00094) }} $</td>
          </tr>
          @endforeach
        </tbody>
      </table>

              </div>
          </div>
      </div>



  </div>

  @include('layouts.datatable-layout')
  <script type="text/javascript" src="{{  asset('/js/bithumb.js') }}"></script>
  {{-- <script>
  function updateChange() {
      var rate = document.getElementById("krw_to_usd").value;
      var list = document.getElementsByName("rate_updatable");

      for (var div of list) {
        var krw_value = div.getAttributeNode("data-value").value;
        var new_value = (krw_value*rate).toFixed(2);  
        div.innerHTML = new_value + " $";  
      }
  }
  </script> --}}
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