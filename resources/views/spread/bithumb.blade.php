@extends('layouts.app')

@section('content')
<div class="container">
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
              <th class="text-center"> Binance Diff </th>
              <th class="text-center"> Bittrex </th>
              <th class="text-center"> Bittrex Diff % </th>
              <th class="text-center"> Bittrex Diff </th>
            </tr>
          </thead>
          <tbody>
           @foreach($data as $symbol => $coin)
           <tr class="
           @if(isset($coin['binance-diff-perc']))
           {{ $coin['binance-diff-perc'] > 10 ? "info" : ""  }}
           {{ $coin['binance-diff-perc'] < -10 ? "success" : ""  }}
           @endif
           @if(isset($coin['bittrex-diff-perc']))
           {{ $coin['bittrex-diff-perc'] > 10 ? "info" : ""  }}           
           {{ $coin['bittrex-diff-perc'] < -10 ? "success" : ""  }}
           {@endif
           ">
           <td> {{ $symbol }}
            @if(!in_array($symbol, $available_withdrawal))
            <span style="color: red;"> *</span>
            @endif
          </td>
          <td class="text-right" data-value="{{ $coin['bithumb'] }}"> {{ number_format($coin['bithumb'],2) }} $</td>
          @if(isset($coin['binance']))
          <td class="text-right" data-value="{{ $coin['binance'] }}"> {{ number_format($coin['binance'],2) }} $</td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['binance-diff-perc']))
          <td class="text-right" data-value="{{ $coin['binance-diff-perc'] }}" style="color:{{ $coin['binance-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff-perc'],3) }} % </td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['binance-diff']))
          <td class="text-right" data-value="{{ $coin['binance-diff'] }}" style="color:{{ $coin['binance-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff'] ,2)}} $</td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['bittrex']))
          <td class="text-right" data-value="{{ $coin['bittrex'] }}"> {{ number_format($coin['bittrex'],2) }} $</td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['bittrex-diff-perc']))
          <td class="text-right" data-value="{{ $coin['bittrex-diff-perc'] }}" style="color:{{ $coin['bittrex-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bittrex-diff-perc'],3) }} % </td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
          @endif
          @if(isset($coin['bittrex-diff']))
          <td class="text-right" data-value="{{ $coin['bittrex-diff'] }}" style="color:{{ $coin['bittrex-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bittrex-diff'] ,2)}} $</td>
          @else
          <td class="text-right" data-value="0" style="color: blue;"> ##### </td>
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
@endsection