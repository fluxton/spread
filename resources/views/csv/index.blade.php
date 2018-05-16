@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form class="form" action="{{ route('csv-upload') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputFile">Select cvs to upload:</label>
                    <input type="file" class="form-control-file" id="csv_file" name="csv_file" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Select the csv file from your fyle system.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        
        </div>
    </div>

    <br><br><br>

    <div class="row">
        <div class="col-md-8">
            <form class="form" action="{{ route('csv-upload-all') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputFile">Select cvs to upload :</label>
                    <input type="file" class="form-control-file" id="csv_file" name="csv_file" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Select the csv file from your fyle system. This one generates total reports.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        
        </div>
    </div>

    <br><br><br>

    @if(isset($results_array))

        <div class="row">
            <div class="col-md-8 text-center">
                <div class="panel panel-default">
                
                    <table class="table table-striped table-bordered sortable">
                        <thead>
                            <tr>
                                @foreach(array_keys($results_array) as $key)
                                    <th class="text-center"> {{ $key }} </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                @foreach($results_array as $value)
                                    <td class="text-right" data-value="{{ $value }}">{{ $value }}</td>
                                @endforeach
                            </tr>                            
                        </tbody>
                    </table>

                    {{-- @foreach($results_array as $key => $value)
                        <p>{{ $key }}= {{ $value }}</p>
                    @endforeach  --}}       
                
                
                </div>
            </div>
        </div>

    @endif

    @if(isset($data_array))

        <br><br><br>

        <div class="row">
            <div class="col-md-10">                
                <div class="panel panel-default">
                    <table class="table table-striped table-bordered sortable">
                        <thead>
                            <tr>
                                @foreach($data_keys as $key)
                                    <th class="text-center"> {{ $key }} </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_array as $row)
                                <tr>
                                    @foreach($row as $value)
                                        <td class="text-right" data-value="{{ $value }}">{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    @endif

    
    
  


</div>




@endsection
