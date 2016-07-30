@extends('app')
@section('head')
<link rel="canonical" href="{{url('/carpool-from-'.$location->getFinalLocality())}}" />
@endsection
@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li class="active">Carpool in {{$location->getFinalLocality()}}</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Carpools from {{$location->getFinalLocality()}}</div>
                <div class="panel-body">
                    @if(count($fromLoc)>0)
                    <ul>
                    @foreach($fromLoc as $loc)
                    <li class="col-md-6 home-locations">
                        @if(in_array($loc->locality, config('carpool.distLocalities')))
                        <a href="{{url('/carpool-from-'.$location->getFinalLocality().'/to-'.$loc->district)}}" title="Carpool from {{$location->getFinalLocality()}} to {{$loc->district}}">{{$loc->district}}</a>   
                        @else
                        <a href="{{url('/carpool-from-'.$location->getFinalLocality().'/to-'.$loc->locality)}}" title="Carpool from {{$location->locality}} to {{$loc->locality}}">{{$loc->locality}}</a>   
                        @endif
                    </li>
                    @endforeach()
                    </ul>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Carpools to {{$location->getFinalLocality()}}</div>
                <div class="panel-body">
                    
                    @if(count($toLoc)>0)
                    <ul>
                    @foreach($toLoc as $loc)
                    <li class="col-md-6 home-locations">
                        @if(in_array($loc->locality, config('carpool.distLocalities')))
                        <a href="{{url('/carpool-from-'.$loc->district.'/to-'.$location->getFinalLocality())}}" title="Carpool from {{$location->getFinalLocality()}} to {{$loc->district}}">{{$loc->district}}</a>   
                        @else
                        <a href="{{url('/carpool-from-'.$loc->locality.'/to-'.$location->getFinalLocality())}}" title="Carpool from {{$location->locality}} to {{$loc->locality}}">{{$loc->locality}}</a>   
                        @endif
                    </li>
                    @endforeach()
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection