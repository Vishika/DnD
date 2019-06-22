@extends('layouts.app')
@section('title', 'Users')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Users') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="register-discord-user" type="submit">{{ __('Register Discord User') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
            <form id="register-discord-user" method="POST" action="/registrable/create">
                @csrf
        		@method('GET')
        	</form>
        	
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

		</div>
        
    @endcomponent
@endsection