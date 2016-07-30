@extends('app')
@section('head')
<link rel="canonical" href="{{url('/carpool-from-'.$location->getFinalLocality())}}" />
@endsection
@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li class="active">Carpool from {{$location->getFinalLocality()}}</li>
</ol>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Carpool from {{$location->getFinalLocality()}}</h1></div>
                <div class="panel-body">
                    @if(count($fromLoc)>0)
                    @foreach($fromLoc as $loc)
                    <div class="col-md-6 col-sm-6 col-xs-12 home-locations">
                        @if(in_array($loc->locality, config('carpool.distLocalities')))
                        <a href="{{url('/carpool-from-'.$location->getFinalLocality().'/to-'.$loc->district)}}" title="Carpool from {{$location->getFinalLocality()}} to {{$loc->district}}">Carpool from {{$location->getFinalLocality()}} to {{$loc->district}}</a>   
                        @else
                        <a href="{{url('/carpool-from-'.$location->getFinalLocality().'/to-'.$loc->locality)}}" title="Carpool from {{$location->getFinalLocality()}} to {{$loc->locality}}">Carpool from {{$location->getFinalLocality()}} to {{$loc->locality}}</a>   
                        @endif
                    </div>
                    @endforeach()
                    @endif
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection