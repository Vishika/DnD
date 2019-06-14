@extends('layouts.app')
@section('header', 'Sessions')
@section('content')
	
	@if (Auth::user()->isAdmin() || Auth::user()->isDm())
    	<div class="form-group row">
            <div class="col-md-6">
                <form method="POST" action="/session/create">
                	@csrf
                	@method('GET')
                    <button type="submit" class="btn btn-primary">{{ __('Log Session') }}</button>
            	</form>
            </div>
        </div>
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
                            	<a title="{{ $sc->note }}" class="{{ $sc->dm ? 'active dm' : ($sc->character->active ? 'active' : 'inactive') }}" href="/user/{{ $sc->character->user_id }}/character/{{ $sc->character->id }}">{{ __($sc->character->name) }}</a>
    						@endforeach
						</td>
    				</tr>
                @endforeach
          </tbody>          
        </table>
    </div>
	
@endsection