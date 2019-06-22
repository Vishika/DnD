@extends('layouts.app')
@section('title', 'Login')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Welcome') }}</a>
    			</div>
                <div class="ml-auto">
                	@if (Route::has('password.request'))
                        <a class="btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <button class="header-item" form="login" type="submit">{{ __('Login') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
            <form id="login" method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Alias') }}</label>
            
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

            </form>
		</div>

    @endcomponent
@endsection