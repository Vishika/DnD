<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'D&D')</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark border-red">
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
                            @if (Auth::user()->isDm())
                                <li class="nav-item">
                                    <a class="nav-link" href="/user">{{ __('Users') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/user/{{ Auth::user()->id }}/character">{{ __('Characters') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/session">{{ __('Sessions') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/signup">{{ __('Sign up') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/enchantment">{{ __('Enchantments') }}</a>
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

		@if(session('message'))
			<div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
						<div class="alert alert-info alert-block my-6">
                        	<button type="button" class="close" data-dismiss="alert">x</button>	
                        	<strong>{{ session('message') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
		@endif

        @yield('page')

    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(".slide").click(function() {
            $(this).parent().parent().next().slideToggle("slow");
        });
    </script>
    @yield('script')
    
</body>
</html>
