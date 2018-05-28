@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form class="form" action="{{ route('csv-upload-all') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputFile">Select cvs to upload:</label>
                    <input type="file" class="form-control-file" id="csv_file" name="csv_file" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Select the csv file from your fyle system. for now it will handle only binance reports.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        
        </div>
    </div>

    <br><br><br>
    
    @if(isset($total_usdt))

    <div class="row">
            <div class="col-md-8 text-center">
                <div class="panel panel-default">

                    <table class="table table-striped table-bordered sortable">
                        <thead>
                            <tr>
                                <th class="text-center"> Total Gain/Loss in USD $</th>
                                <th class="text-center"> Diff 24h </th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                <td class="text-right" style="color:{{ $total_usdt['gain_loss'] < 0 ? " red" : " green"  }} ;">{{ number_format($total_usdt['gain_loss'],8) }} $</td>
                                <td class="text-right" style="color:{{ $total_usdt['diff_24h'] < 0 ? " red" : " green"  }} ;">{{ number_format($total_usdt['diff_24h'],8) }} $</td>                                
                            </tr>
                        </tbody>
                    </table>
                
                
                </div>
            </div>
        </div>

    <br><br><br>

    @endif
    

    @if(isset($total_balance))

    <div class="row">
            <div class="col-md-8 text-center">
                <div class="panel panel-default">

                    <table class="table table-striped table-bordered sortable">
                        <thead>
                            <tr>
                                <th class="text-center"> Market </th>
                                <th class="text-center"> Total Gain/Loss </th>
                                <th class="text-center"> Diff 24h </th>
                                <th class="text-center"> Total Gain/Loss USD </th>
                                <th class="text-center"> Diff 24h USD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($total_balance as $market => $values)
                            <tr>
                                <td class="text-right" >{{ $market }}</td>
                                <td class="text-right" style="color:{{ $values['gain_loss'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['gain_loss'],6) }}</td>
                                <td class="text-right" style="color:{{ $values['diff_24h'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['diff_24h'],6) }}</td>   
                                <td class="text-right" style="color:{{ $values['gain_loss_usdt'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['gain_loss_usdt'],4) }} $</td>
                                <td class="text-right" style="color:{{ $values['diff_24h_usdt'] < 0 ? " red" : " green"  }} ;" >{{ number_format($values['diff_24h_usdt'],4) }} $</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                
                </div>
            </div>
        </div>

    <br><br><br>

    @endif
    
    

    @if(isset($coins))
    
    @foreach($coins as $symbol => $markets)
    
    <h2>{{ $symbol }}</h2>

        <div class="row">
            <div class="col-md-10 text-center">
                <div class="panel panel-default">

                     <table class="table table-striped table-bordered sortable">
                        <thead>
                            <tr>
                                <th class="text-center"> Market </th>
                                <th class="text-center"> Coin Amount </th>
                                <th class="text-center"> Balance </th>
                                <th class="text-center"> Avg Price </th>
                                <th class="text-center"> Price now</th>
                                <th class="text-center"> Value Now</th>
                                <th class="text-center"> Gain / Loss </th>
                                <th class="text-center"> Diff 24h </th>
                                <th class="text-center"> fees (BNB) </th>
                                
                                <th class="text-center"> Diff 24h %</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach($markets as $market => $values)
                                <tr>
                                    <td class="text-right" >{{ $market }}</td>
                                    <td class="text-right" >{{ number_format($values['amount'],4) }}</td>
                                    <td class="text-right" >{{ number_format($values['balance'],6) }}</td>
                                    <td class="text-right" >{{ number_format($values['avg_cost'],6) }}</td>
                                    <td class="text-right" >{{ number_format($values['exchange_price'],6) }}</td>
                                    <td class="text-right" >{{ number_format($values['total_coin_value'],6) }}</td>
                                    <td class="text-right" style="color:{{ $values['gain_loss'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['gain_loss'],6) }}</td>
                                    <td class="text-right" style="color:{{ $values['diff_24h'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['diff_24h'],6) }}</td>
                                    <td class="text-right" >{{ number_format($values['fees'],6) }}</td>                                    
                                    <td class="text-right" style="color:{{ $values['price_change_percent'] < 0 ? " red" : " green"  }} ;">{{ number_format($values['price_change_percent'],3) }} %</td>
                                </tr>
                            @endforeach                
                        </tbody>
                    </table>   
                
                
                </div>
            </div>
        </div>
    
    @endforeach     

    @endif
    
    
  


</div>



<!--@include('layouts.datatable-layout')-->
 

@endsection
