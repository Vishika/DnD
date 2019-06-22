@extends('layouts.app')
@section('title', $user->name)
@section('page')
    @component('layouts.card')
    	@slot('header')
    		{{ $user->name }}
    	@endslot

    	<div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly="readonly">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="discord_name" class="col-md-4 col-form-label text-md-right">{{ __('Discord Name') }}</label>
            <div class="col-md-6">
                <input id="discord_name" type="text" class="form-control" name="discord_name" value="{{ $user->discord_name }}" readonly="readonly">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly="readonly">
            </div>
        </div>
        
        @can('owner', $user)
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <form method="POST" action="/user/{{ $user->id }}/edit">
                    @csrf
                    @method('GET')
                    <button type="submit" name="submit" value="edit" class="btn btn-primary">{{ __('Edit') }}</button>
                    <button type="submit" name="submit" value="edit-password" class="btn btn-primary">{{ __('Change Password') }}</button>
            	</form>
            </div>
        </div>
        @endcan
    
        @if (count($user->characters) > 0)
        	<div class="form-group row">
        		<label class="col-md-4 col-form-person-label text-md-right">{{ __('Characters') }}</label>
                <div class="col-md-6 people">
                @foreach ($user->characters as $character)
                	<a class="{{ $character->active ? 'active' : 'inactive' }}" href="/user/{{ $user->id }}/character/{{ $character->id }}">{{ __($character->name) }}</a>
                @endforeach
                </div>
            </div>
        @endif
    
        @if (Auth::user()->isAdmin() || !$user->reachedCharacterLimit())
        	@can('owner', $user)
            	<div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <form method="POST" action="/user/{{ $user->id }}/character/create">
                        	@csrf
                    		@method('GET')
                            <button type="submit" class="btn btn-primary">{{ __('New Character') }}</button>
                    	</form>
                    </div>
                </div>
            @endcan
        @endif
    
    @endcomponent
@endsection