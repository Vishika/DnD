@extends('layouts.app')
@section('title', $user->name)
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ $user->name }}</a>
    			</div>
                @can('owner', $user)
                    <form class="ml-auto" id="edit-user" method="POST" action="/user/{{ $user->id }}/edit">
                        @csrf
                        @method('GET')
                        <button class="header-item" form="edit-user" name="submit" type="submit" value="edit-password">{{ __('Change Password') }}</button>
                        <button class="header-item" form="edit-user" name="submit" type="submit" value="edit">{{ __('Edit User') }}</button>
                	</form>
    			@endcan
            </div>
    	</div>

        <div class="card-body">

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

		</div>
	@endcomponent

	@component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Characters') }}</a>
    			</div>
    			@if (Auth::user()->isAdmin() || !$user->reachedCharacterLimit())
                	@can('owner', $user)
                        <div class="ml-auto">
                            <button class="header-item" form="new-character" type="submit" value="edit">{{ __('New Character') }}</button>
                        </div>
                    @endcan
    			@endif
            </div>
    	</div>

        <div class="card-body">

			@if (Auth::user()->isAdmin() || !$user->reachedCharacterLimit())
            	@can('owner', $user)
                    <form id="new-character" method="POST" action="/user/{{ $user->id }}/character/create">
                    	@csrf
                		@method('GET')
                	</form>
                @endcan
            @endif
        
            @if (count($user->characters))
                <div class="people">
                @foreach ($user->characters->sortByDesc('experience') as $character)
                	<a class="{{ $character->active ? 'active' : 'inactive' }}" href="/user/{{ $user->id }}/character/{{ $character->id }}">{{ __($character->name) }}</a>
                @endforeach
                </div>
            
        
                <div class="overflow">
                    <table class="table alternating">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Experience</th>
                                <th>Gold</th>
                            </tr>
                        </thead> 
                        <tbody>
                        	@foreach ($user->characters->sortByDesc('experience') as $character)
                				<tr>
                                    <td>{{ $character['name'] }}</td>
                                    <td>{{ $character['level'] }}</td>
                                    <td>{{ $character['experience'] }}</td>
                                    <td>{{ $character['gold'] }}</td>
                				</tr>
                            @endforeach
                      </tbody>          
                    </table>
                </div>
			@endif
		</div>
    
    @endcomponent
@endsection