<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Fortunes Dawn')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #252525;
                color: #C1C1C1;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            
            .content-wrapper {
                text-align: center;
            }

            .content {
                display: inline-block;
                background-color: #FEFEFE;
                color: #000;
                text-align: left;
                width: 400px;
                min-height: 300px;
                border: 2px solid #BF2F2F;
                border-radius: 1em;
                box-shadow: 0.2em 0.2em 0.2em black;
                padding: 1em 1em;
            }

            .title {
                font-size: 84px;
                padding: 20px;
            }
            
            .links {
                padding: 20px;
                background-color: #090809;
                border-bottom: 2px solid #BF2F2F;
                
            }
            
            .links > a {
                color: #a5afba;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            .wrapper {
                padding: 0;
            }
            .form-row {
                display: flex;
                justify-content: flex-end;
                padding: .5em;
            }
            .form-row > label {
                padding: .5em 1em .5em 0;
                flex: 1;
            }
            .form-row > input {
                border-radius: 1em;
                font-family: 'Nunito', sans-serif;
                padding: .5em;
                flex: 1.5;
            }
            
            .button-wrapper {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
            }
            
            button, .button {
                font-family: 'Nunito', sans-serif;
                font-size: 1em;
                text-decoration: none;
                text-align: center;
                background-color: #BF2F2F;
                width: 100px;
                border: 2px solid #26282A;
                border-radius: 1em;
                color: #ffffff;
                position: relative;
                padding: 0;
                margin: 0.2em;
            }
            
            button:hover, .button:hover {
                background-color: #8FBF2F;
                border: 2px solid #26282A;
                cursor: pointer;
            }
            
            .active {
                background-color: #090809;
                border: 2px solid #BF2F2F;
            }
            
            .inactive {
                background-color: #C1C1C1;
            }
            
            .errors {
                background-color: #FF6961;
                colour: #FFFFFF;
                border: 2px solid #BF2F2F;
                border-radius: 1em;
                padding: 1em;
                margin: 1em;
                font-weight: bold;
            }
            
        </style>
    </head>
    <body>
    	<div class="links flex-center">
			<a href="/">Home</a>
            <a href="/user">Users</a>
            <a href="/character">Characters</a>
            <a href="/session">Sessions</a>
        </div>
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div>
            	<div class="title">@yield('title', 'Fortunes Dawn')</div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
