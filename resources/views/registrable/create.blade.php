@extends('layouts.app')
@section('header', 'Register Discord User')
@section('page')
    @component('layouts.card')

    	<form method="POST" action="/registrable">
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
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </div>
    	</form>

    @endcomponent
@endsection