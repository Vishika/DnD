@extends('layouts.app')
@section('title', 'Register Discord User')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Register Discord User') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="register" type="submit">{{ __('Register') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
        	<form id="register" method="POST" action="/registrable">
                @csrf
                
                <div class="form-group row">
                    <label for="discord_name" class="col-md-4 col-form-label text-md-right">{{ __('Discord Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="discord_name" type="text" class="form-control @error('discord_name') is-invalid @enderror" name="discord_name" value="{{ old('discord_name') }}" required autofocus>
            
                        @error('discord_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

        	</form>
		</div>

    @endcomponent
@endsection