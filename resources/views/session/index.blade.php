@extends('layouts.app')
@section('title', 'Sessions')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Sessions') }}</a>
    			</div>
    			@can (Auth::user()->isAdmin() || Auth::user()->isDm())
                    <div class="ml-auto">
                        <button class="header-item" form="log-session" type="submit">{{ __('Log Session') }}</button>
                    </div>
                @endif
            </div>
    	</div>

        <div class="card-body">
        	@can (Auth::user()->isAdmin() || Auth::user()->isDm())
                <form id="log-session" method="POST" action="/session/create">
                	@csrf
                	@method('GET')
            	</form>
            @endif
        	
        	<div class="overflow">
            	<table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>DM</th>
                            <th>Difficulty</th>
                            <th>Duration</th>
                        </tr>
                    </thead> 
                    <tbody>
                    	@foreach ($sessions as $session)
            				<tr title="{{ $session->note }}">
                                <td>{{ date('d/m/Y', strtotime( $session->created_at )) }}</td>
                                <td class="shorten" title="{{ $session->name }}">{{ $session->name }}</td>
                                <td>{{ $session->user->name }}</td>
                                <td>{{ ucwords($session->difficulty) }}</td>
                                <td>{{ $session->duration }}</td>
            				</tr>
            				<tr>
            					<td colspan="5">
                					@foreach ($session->sessionCharacters as $sc)
                						@if ((Auth::user()->isAdmin() || Auth::user()->isDm()) || (!$sc->dm))
                							<a title="{{ $sc->note }}" class="{{ $sc->dm ? 'active dm' : 'active' }}" @if (Auth::user()->isAdmin() || Auth::user()->isDm()) href="/user/{{ $sc->character->user_id }}/character/{{ $sc->character->id }}" @endif >{{ __($sc->character->name) }}</a>
                						@endif
            						@endforeach
        						</td>
            				</tr>
                        @endforeach
                  </tbody>          
                </table>
            </div>

		</div>

    @endcomponent
@endsection