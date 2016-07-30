@extends('app')

@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li class="active">Search</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search Carpools</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" >
                        
                        <div class="row">
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="From Location" name="from" value="@if(isset($from)){{ $from }}@endif" required />
                                
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="To Location" name="to" value="@if(isset($to)){{ $to }}@endif" required />
                                
                            </div>
                        
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary ">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @if(isset($from) && isset($to))
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Carpool Result:{{$carpools->count()}} </div>
                <div class="panel-body  table-responsive">
                    @if($carpools->count()>0)
                        @include('carpool.table')
                    @else
                    <h3>No Result can be found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection