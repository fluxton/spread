@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div id="usdt" class="panel panel-default">
        <table class="table"  table-striped>
          <thead>
            <tr>
              <th> coin </th>
              <th class="text-right"> Bithumb </th>   
              <th class="text-right"> Binance </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
              <th class="text-right"> Bittrex </th>
              <th class="text-right"> Price Diff % </th>
              <th class="text-right"> Price Diff </th>
            </tr>
          </thead>
          <tbody>
           @foreach($data as $symbol => $coin)
           <tr>
            <td> {{ $symbol }} </td>
            <td class="text-right"> {{ number_format($coin['bithumb'],2) }} $</td>
            @if(isset($coin['binance']))
              <td class="text-right"> {{ number_format($coin['binance'],2) }} $</td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff-perc']))
              <td class="text-right" style="color:{{ $coin['binance-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff-perc'],3) }} % </td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['binance-diff']))
              <td class="text-right" style="color:{{ $coin['binance-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['binance-diff'] ,2)}} $</td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bittrex']))
              <td class="text-right"> {{ number_format($coin['bittrex'],2) }} $</td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bittrex-diff-perc']))
              <td class="text-right" style="color:{{ $coin['bittrex-diff-perc'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bittrex-diff-perc'],3) }} % </td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
            @if(isset($coin['bittrex-diff']))
              <td class="text-right" style="color:{{ $coin['bittrex-diff'] < 0 ? " red" : " green"  }} ;"> {{ number_format($coin['bittrex-diff'] ,2)}} $</td>
            @else
              <td class="text-right" style="color: blue;"> ##### </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>


  </div>
</div>



</div>
@endsection