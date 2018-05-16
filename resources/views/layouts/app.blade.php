<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SpreadTool') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Home
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('coinmarketcap') }}">Coinmarketcap</a></li>
                        <li class="nav-item dropdown">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Single Exchanges<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('binance') }}">Binance</a></li>
                                <li><a href="{{ route('bitfinex') }}">Bitfinex</a></li>
                                <li><a href="{{ route('bittrex') }}">Bittrex</a></li>
                                <li><a href="{{ route('bithumb') }}">Bithumb</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Spreads<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('spread-bithumb') }}">Spread-Bithumb</a></li>
                                <li><a href="{{ route('spread-binance') }}">Spread-Binance</a></li>
                                <li><a href="{{ route('spread-bittrex') }}">Spread-Bittrex</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Upload Csv data<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('csv-index') }}">Single Coin Data</a></li>
                                <li><a href="{{ route('csv-show') }}">Overall data analysis</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('post-index') }}">Idea & Suggestions</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://github.com/fluxton/spread">GitHub/Spread</a></li>
                    </ul>

                    {{-- <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="https://github.com/fluxton/spread">GitHub/Spread</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul> --}}
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script type="text/javascript">
        require( 'datatables.net-bs4' )();
        require( 'datatables.net-buttons-bs4' )();
        require( 'datatables.net-buttons/js/buttons.colVis.js' )();
        require( 'datatables.net-fixedheader-bs4' )();
    </script> --}}
</body>
</html>
