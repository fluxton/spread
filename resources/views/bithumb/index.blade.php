@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-6">
      Korean Won Excange rate: <input type="text"  value="{{ $default_rate }}" id="krw_to_usd">&nbsp;<input type="button" value="update data" onclick="updateChange()">
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
           <tr>
            <td> {{ $symbol }} </td>
            <td name="rate_updatable" class="text-right" data-value="{{ $coin['sell_price'] }}"> {{ number_format($coin['sell_price']*$default_rate,2) }} $</td>
            <td name="rate_updatable" class="text-right" data-value="{{ $coin['max_price'] }}"> {{ number_format($coin['max_price']*$default_rate,2) }} $</td>
            <td name="rate_updatable" class="text-right" data-value="{{ $coin['min_price'] }}"> {{ number_format($coin['min_price']*$default_rate,2) }} $</td>
            <td name="volume_updatable" class="text-right" data-value="{{ $coin['volume_1day'] }}"> {{ intval($coin['volume_1day']*$coin['sell_price']*0.00094) }} $</td>
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
  function updateChange() {
      var rate = document.getElementById("krw_to_usd").value;
      var list = document.getElementsByName("rate_updatable");

      for (var div of list) {
        var krw_value = div.getAttributeNode("data-value").value;
        var new_value = (krw_value*rate).toFixed(2);  
        div.innerHTML = new_value + " $";  
      }
  }
  </script>
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