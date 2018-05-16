@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 text-center">
        <p class="text-center">Korean Won to US Dollar Exchange rate: <strong id="krw_to_usd">{{ $exchange_rate }}</strong></p>
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
      <div id="usdt" class="panel panel-default">
        <table class="table table-striped table-bordered sortable">
          <thead>
            <tr>
              <th> coin </th>
              <th class="text-center"> Bithumb </th>   
              <th class="text-center"> Binance </th>
              <th class="text-center"> Binance Diff % </th>
              <th class="text-center"> Bittrex </th>
              <th class="text-center"> Bittrex Diff % </th>
            </tr>
          </thead>
          <tbody>
           @foreach($full_spread as $symbol => $coin)
           <tr class="
           {{-- @if(isset($coin['binance-diff-perc']))
           {{ $coin['binance-diff-perc'] > 10 ? "info" : ""  }}
           {{ $coin['binance-diff-perc'] < -10 ? "success" : ""  }}
           @endif
           @if(isset($coin['bittrex-diff-perc']))
           {{ $coin['bittrex-diff-perc'] > 10 ? "info" : ""  }}           
           {{ $coin['bittrex-diff-perc'] < -10 ? "success" : ""  }}
           {@endif --}}
           ">
           <td> {{ $symbol }}
            @if(!in_array($symbol, $available_withdrawal))
            <span style="color: red;"> *</span>
            @endif
          </td>
          <td id="{{ $symbol }}_bithumb" class="text-right" data-value="{{ $coin['bithumb'] }}"> {{ number_format($coin['bithumb'],2, '.', ',') }} $</td>
          @if(isset($coin['binance']))
          <td id="{{ $symbol }}_binance" class="text-right" data-value="{{ $coin['binance'] }}"> {{ number_format($coin['binance'],2, '.', ',') }} $</td>
          @else
          <td id="{{ $symbol }}_binance" class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['binance_diff_perc']))
          <td id="{{ $symbol }}_binance_diff_perc" class="text-right" data-value="{{ $coin['binance_diff_perc'] }}" style="color:{{ $coin['binance_diff_perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance_diff_perc'],3) }} % </td>
          @else
          <td id="{{ $symbol }}_binance_diff_perc" class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          
          @if(isset($coin['bittrex']))
          <td id="{{ $symbol }}_bittrex" class="text-right" data-value="{{ $coin['bittrex'] }}"> {{ number_format($coin['bittrex'],2, '.', ',') }} $</td>
          @else
          <td id="{{ $symbol }}_bittrex" class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['bittrex_diff_perc']))
          <td id="{{ $symbol }}_bittrex_diff_perc" class="text-right" data-value="{{ $coin['bittrex_diff_perc'] }}" style="color:{{ $coin['bittrex_diff_perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bittrex_diff_perc'],3) }} % </td>
          @else
          <td id="{{ $symbol }}_bittrex_diff_perc" class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p><span style="color: red;">* </span>These coins are not available for withdrawal from bithumb. That means you can send these coins to bithumb wallet but you can't send them from bithumb to another wallet.</p>


</div>
</div>



</div>

@include('layouts.datatable-layout')
  <script type="text/javascript" src="{{  asset('/js/spread-bithumb.js') }}"></script>
{{-- <script src="/js/spread-bithumb.js"></script> --}}
{{-- @include('scripts.bithumb') --}}
@endsection