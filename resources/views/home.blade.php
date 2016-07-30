@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Carpool from the following locations</h1>
                </div>

                <div class="panel-body">
                        @foreach($locations as $loc)
                        <div class="col-lg-3 col-md-4 col-sm-6  @if(strpos(trim($loc->getFinalLocality()),' ')!==false) col-xs-12  @else col-xs-6 @endif home-locations" itemscope itemtype="http://schema.org/Place" >
                            <a href="{{ url('/carpool-from-'.$loc->getFinalLocality()) }}" title="Carpool from {{$loc->getFinalLocality()}}" ><span itemprop="name">{{$loc->getFinalLocality()}}</span></a>
                        </div>
                        @endforeach
                   
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Why sameroute.in</div>

                <div class="panel-body">
                    Our aim is to save environment and petrol. 
                    We have provided a tool to find people who are traveling in to the same route.
                    Find people who are in to the www.sameroute.in. It will be a great pleasure to us if you find companions.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Recent carpools</div>
                    <div class="panel-body table-responsive">
                        @include('carpool.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection