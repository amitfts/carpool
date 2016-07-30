@extends('app')

@section('content')
@if(isset($me)==false)
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li><a href="{{ url('/carpool-from-'.$fromLoc) }}">Carpool from {{$fromLoc}}</a></li>
  <li class="active">@if(isset($title)){{$title}} @else Carpool @endif</li>
</ol>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>@if(isset($title)){{$title}} @else Carpool @endif</h1></div>
                <div class="panel-body  table-responsive">
                    
                  @include('carpool.table')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection