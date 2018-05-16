@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <form method="POST" action="/post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="title here...">
                </div>                
              
                <div class="form-group">
                    <label for="body">Content </label>
                    <textarea class="form-control" id="body" name="body" rows="3" value="write any idea or suggestion..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
           
        
        </div>
    </div>
</div>


@endsection
