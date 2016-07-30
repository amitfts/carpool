<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>@if(isset($title)){{$title}}@else Sameroute.in @endif</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description"  content="@if(isset($metaDesc)){{$metaDesc}}@endif Carpool, rideshare, odd even carpool in sameroute.in. " />
        <meta name="keywords"  content="@if(isset($metaKey)){{$metaKey}}@endif odd even, rideshare, carpooling, sameroute" />
        <meta property="og:url" content="{{Request::url()}}" />
        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="994531767281439" />
        <meta property="og:title" content="@if(isset($title)){{$title}}@else Sameroute.in @endif" />
        <meta property="og:description" content="@if(isset($metaDesc)){{$metaDesc}}@endif Carpool, rideshare, odd even carpool in sameroute.in" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('/favicon.ico') }}" />
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css' />
        @yield('head')
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-71396068-1', 'auto');
            ga('send', 'pageview');

        </script>
       
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Sameroute.in</a>

                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('/') }}" title="Go to Home Page">Home</a>
                        </li>
                        <li>
                            <a href="{{ url('/search') }}" >Search</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact-us') }}" >Contact Us</a>
                        </li>

                        @if (!Auth::guest())
                        <li>
                            <a href="{{ url('/new-carpool') }}" title="Create Carpool">Create Carpool</a>
                        </li>
                        <li>
                            <a href="{{ url('/my-carpools') }}" title="My Carpools">My Carpools</a>
                        </li>

                        @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <footer class="footer">
            <div class="container">
                <p class="text-muted">&copy {{date('Y')}} sameroute.in </p>
            </div>
        </footer>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
        @yield('foot')
    </body>
</html>
