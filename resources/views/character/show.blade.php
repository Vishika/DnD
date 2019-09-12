@extends('layouts.app')
@section('title', $character->name)
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ $character->name }}</a>
    			</div>
    			@can('owner', $user)
                <div class="ml-auto">
                    <button class="header-item" form="edit-character" type="submit">{{ __('Edit') }}</button>
                </div>
                @endcan
            </div>
    	</div>

    	<div class="card-body">
            <form id="edit-character" method="POST" action="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}/edit">
            	@csrf
            	@method('GET')
        	</form>
    
        	<div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $character->name }}" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="race" class="col-md-4 col-form-label text-md-right">{{ __('Race') }}</label>
                <div class="col-md-6">
                    <input id="race" type="text" class="form-control" name="race" value="{{ $character->race }}" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>
                <div class="col-md-6">
                    <input id="class" type="text" class="form-control" name="class" value="{{ $character->class }}" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="gold" class="col-md-4 col-form-label text-md-right">{{ __('Gold') }}</label>
                <div class="col-md-6">
                    <input id="gold" type="text" class="form-control" name="gold" value="{{ $character->gold }}" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="experience" class="col-md-4 col-form-label text-md-right">{{ __('Experience') }}</label>
                <div class="col-md-6">
                    <input id="experience" type="text" class="form-control" name="experience" value="{{ $character->experience }}" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                <div class="col-md-6">
                    <input id="level" type="text" class="form-control" name="level" value="{{ $character->level }}" readonly="readonly">
                </div>
            </div>
		</div>
        
    @endcomponent

	@component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Notes') }}</a>
    			</div>
    			@can('owner', $user)
                <div class="ml-auto">
                    <button class="header-item" form="edit-character" type="submit">{{ __('Edit') }}</button>
                </div>
                @endcan
            </div>
    	</div>

    	<div class="card-body" style="display: none;">
            <form id="edit-character" method="POST" action="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}/edit">
            	@csrf
            	@method('GET')
        	</form>
    		<textarea class="form-control note space-below" readonly="readonly">{{ $character->note }}</textarea>
            @can('dm', $user)
            	<p>DM note</p>
                <textarea class="form-control note" readonly="readonly">{{ $character->dm_note }}</textarea>
            @endcan
		</div>
        
    @endcomponent

	@if (count($character->sessionCharacters))
        @component('layouts.card')
    
        	<div class="card-header">
            	<div class="header-row">
            		<div class="mr-auto slide">
            			<a class="header-item">{{ __('Adventures') }}</a>
        			</div>
                </div>
        	</div>
    
        	<div class="card-body" style="display: none;">
            
                <div class="overflow">
                    <table class="table alternating">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gold</th>
                                <th>Experience</th>
                            </tr>
                        </thead> 
                        <tbody>
                        	@foreach ($character->sessionCharacters as $sessionCharacter)
                				<tr>
                                    <td>{{ $sessionCharacter->session['name'] }}</td>
                                    <td>{{ $sessionCharacter['gold'] }}</td>
                                    <td>{{ $sessionCharacter['experience'] }}</td>
                				</tr>
                            @endforeach
                      </tbody>
                    </table>
                </div>
    		</div>
        	
        @endcomponent
	@endif

    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Trades') }}</a>
    			</div>
    			@can('dm', $user)
                    <div class="ml-auto">
                        <button class="header-item" form="trade" type="submit">{{ __('Trade') }}</button>
                    </div>
                @endcan
            </div>
    	</div>

    	<div class="card-body" style="display: none;">
            <form id="trade" method="POST" action="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}/trade">
            	@csrf
            	@method('GET')
        	</form>
            
            <div class="overflow">
                <table class="table alternating">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Note</th>
                        </tr>
                    </thead> 
                    <tbody>
                    	@foreach ($character->trades as $trade)
            				<tr>
                                <td>{{ $trade['gold'] }}</td>
                                <td>{{ $trade['note'] }}</td>
            				</tr>
                        @endforeach
                  </tbody>          
                </table>
            </div>
		</div>
    	
    @endcomponent
    
    @if (count($character->contributions))
        @component('layouts.card')
    
        	<div class="card-header">
            	<div class="header-row">
            		<div class="mr-auto slide">
            			<a class="header-item">{{ __('Contributions') }}</a>
        			</div>
        			@can('contribute', $user)
                        <div class="ml-auto">
                            <button class="header-item" form="contribute" type="submit">{{ __('Contribute') }}</button>
                        </div>
                    @endcan
                </div>
        	</div>
    
        	<div class="card-body" style="display: none;">
                <form id="contribute" method="POST" action="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}/contribute">
                	@csrf
                	@method('GET')
            	</form>
            
                <div class="overflow">
                    <table class="table alternating">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Project</th>
                            </tr>
                        </thead> 
                        <tbody>
                        	@foreach ($character->contributions as $contribution)
                				<tr>
                                    <td>{{ $contribution['amount'] }}</td>
                                    <td>{{ $contribution->project['name'] }}</td>
                				</tr>
                            @endforeach
                      </tbody>          
                    </table>
                </div>
    		</div>
        	
        @endcomponent
	@endif

@endsection