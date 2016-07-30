@extends('app')

@section('content')
 <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=994531767281439";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
                </script>
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li><a href="{{ url('/carpool-from-'.$carpool->fromLocation->getFinalLocality()) }}">Carpool from {{$carpool->fromLocation->getFinalLocality()}}</a></li>
  <li><a href="{{ url('/carpool-from-'.$carpool->fromLocation->getFinalLocality().'/to-'.$carpool->toLocation->getFinalLocality()) }}">Carpool from {{$carpool->fromLocation->getFinalLocality()}} to {{$carpool->toLocation->getFinalLocality()}}</a></li>
  <li class="active">Carpool from {{$carpool->from_location}} to {{$carpool->to_location}}</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" itemscope itemtype="http://schema.org/TravelAction">
                <div class="panel-heading" ><h1 itemprop="name">Carpool from {{$carpool->from_location}} to {{$carpool->to_location}}</h1></div>
                <div class="panel-body" >
                    <div class="row lead">
                        <div class="col-md-1 col-xs-3" >From:</div>
                        <div class="col-md-5 col-xs-9" >
                            <span itemprop="fromLocation">{{$carpool->from_location}}</span>
                        </div>
                        <div class="col-md-2 col-xs-4" >Start time:</div>
                        <div class="col-md-3 col-xs-8" >
                            <span itemprop="startTime">{{date('h:i A',strtotime($carpool->start_time))}}</span>
                        </div>
                    </div>
                    <div class="row lead">
                         <div class="col-md-1 col-xs-4" >To:</div>
                        <div class="col-md-5 col-xs-8" >
                            <span itemprop="toLocation">{{$carpool->to_location}}</span>
                        </div>
                        <div class="col-md-2 col-xs-5" >Return Time:</div>
                        <div class="col-md-3 col-xs-7" >
                            <span itemprop="endTime">{{date('h:i A',strtotime($carpool->return_time))}}</span>
                        </div>
                    </div>
                     @if($carpool->regpart2)
                    <div class="row">
                         <div class="col-md-2 col-xs-5" >Registration Number:</div>
                        <div class="col-md-3 col-xs-7" >
                            <span itemprop="toLocation">{{$carpool->regpart1}} {{$carpool->regpart2}}</span>
                        </div>
                        
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12" >
                            @if($carpool->user_type=='B')
                                The member can be driver or passenger.
                            @elseif($carpool->user_type=='D')
                                The member would like to be driver
                            @elseif($carpool->user_type=='P')
                                The member would like to be passenger
                            @endif
                        </div>
                        
                        
                    </div>
                   
                    <hr/>
                    <div class="row">
                        <div class="col-md-9">
                            <span><?php echo nl2br($carpool->details); ?></span>
                        </div>
                        <div class="col-md-3">
                            <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button"></div>
                        </div>
                    </div>
                    <hr/>
                    <div itemprop="agent" itemscope itemtype="http://schema.org/Person" >
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-3 col-xs-8">
                                Sameroute has been created by:
                            </div>
                            <div class="col-md-3 col-xs-4" itemprop="name">{{$carpool->user->name}}</div>
                        </div>
                         @if (Auth::guest())
                         <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-8">
                                <a href="{{ url('/auth/login') }}">Login</a> or <a href="{{ url('/auth/register') }}">Signup</a> to see the contact details and create your own carpool.
                            </div>
                            
                        </div>
                         @else
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-3">
                                Contact me for the above carpool:
                            </div>
                            <div class="col-md-3" itemprop="email">{{$carpool->user->email}}</div>
                        </div>
                         @endif
                         @if(Auth::check() && $carpool->user->id!=Auth::user()->id )
                         <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-8">
                                Create your own carpool and share it to let other know about it.
                            </div>
                           
                        </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection