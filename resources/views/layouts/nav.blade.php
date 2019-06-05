<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('header', 'Fortunes Dawn')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style type="text/css">
    <!--
        .active, .inactive, .registrable {
            border-radius: .25rem;
            border: 1px solid transparent;
            color: #ffffff;
            display: inline-block;
            margin: .25rem;
            padding: .375rem .75rem;
            text-align: center;
            
        }
        .active:hover, .inactive:hover {
            background-color: #191919;
            color: #ffffff;
            text-decoration: none;
        }
        .registrable:hover {
            cursor: default;
        }
        .active {
            background-color: #6574cd;
        }
        .inactive {
            background-color: #cccccc;
        }
        .registrable {
            background-color: #e3342f;
        }
        .people {
            display: block;
            padding: .375rem .75rem;
        }
        .col-form-person-label {
            margin-bottom: 0px;
            line-height: 57px;
        }
        [readonly] {
            cursor: default;
        }
    -->
    </style>
    
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            	@auth
                	<a class="navbar-brand" href="{{ url('/') }}">{{ __('Dashboard') }}</a>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto">
                        	<li class="nav-item">
                                <a class="nav-link" href="/user/{{ Auth::user()->id }}">{{ __('Profile') }}</a>
                            </li>
                            @if (Auth::user()->isAdmin() || Auth::user()->isDm())
                                <li class="nav-item">
                                    <a class="nav-link" href="/user">{{ __('Users') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/character">{{ __('Characters') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/sessions">{{ __('Sessions') }}</a>
                            </li>
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('page')
        </main>
    </div>
    
</body>
</html>
