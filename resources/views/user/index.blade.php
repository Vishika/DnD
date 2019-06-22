@extends('layouts.app')
@section('header', 'Users')
@section('page')
    @component('layouts.card')
    	
        <div class="form-group row">
    		<div class="people">
                @foreach ($users as $user)
                	<a class="button {{ $user->active ? 'active' : 'inactive' }}" href="/user/{{ $user->id }}">{{ $user->name }}</a>
                @endforeach
                @foreach ($registrables as $registrable)
                	<span class="button registrable">{{ $registrable->discord_name }}</span>
                @endforeach
        	</div>
        </div>
        
        <div class="form-group row">
            <div class="col-md-6">
                <form method="POST" action="/registrable/create">
                    @csrf
            		@method('GET')
                    <button type="submit" class="btn btn-primary">{{ __('Register Discord User') }}</button>
            	</form>
            </div>
        </div>
    
    @endcomponent
@endsection