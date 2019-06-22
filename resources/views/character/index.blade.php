@extends('layouts.app')
@section('title', 'Characters')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Characters') }}</a>
    			</div>
            </div>
    	</div>

    	<div class="card-body">
        	@if (!empty($characters))
            	<div class="form-group row">
                    <div class="people">
                        @foreach ($characters as $character)
                        	<a class="{{ $character->isActive() ? 'active' : 'inactive' }}" href="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}">{{ __($character['name']) }}</a>
                        @endforeach
                    </div>
                </div>
                
                <div class="overflow">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>LvL</th>
                                <th>XP</th>
                                <th>GP</th>                      
                            </tr>
                        </thead> 
                        <tbody>
                        	@foreach ($characters as $character)
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