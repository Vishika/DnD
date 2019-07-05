@extends('layouts.app')
@section('title', 'Sign Up')
@section('page')
	@component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Sign Up') }}</a>
    			</div>
    			<div class="ml-auto">
                    <button class="header-item" form="signup" type="submit">{{ __('Save') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
        	@if (count($user->characters))
        		<form id="signup" method="POST" action="/signup">
            		@csrf
           			<div class="overflow">
                        <table class="signup table alternating">
                            <thead>
                                <tr>
                                    <th class="short">Day</th>
                                    <th class="shorter">Tentative?</th>
                                    @if (Auth::user()->isDm())
                                		<th class="shorter">DM</th>
                                    @endif
                                    <th>Who</th>
                                </tr>
                            </thead> 
                            <tbody>
                            	@foreach ($days as $day => $data)
                            		<tr>
                                        <td class="short">{{ $data['date']->format('d/m') }} {{  $data['date']->englishDayOfWeek }}</td>
                                        <td class="shorter"><input type="checkbox" name="tentative[{{ $day }}]" {{ ($data['tentative']) ? 'checked' : '' }}><label>Maybe</label></td>
                                        @if (Auth::user()->isDm())
                                        	<td class="shorter"><input type="checkbox" name="dm[{{ $day }}]" {{ ($data['dm']) ? 'checked' : '' }}><label>DM</label></td>
                                        @endif
                                        <td>
                                            @foreach ($user->characters->sortByDesc('experience') as $character)
                                            	@if ($character->active)
                                        			<input type="checkbox" name="whom[{{ $day }}][]" value="{{ $character->id }}" {{ (array_key_exists($character->id, $data['who'])) ? 'checked' : '' }}><label>{{ $character->name }}</label>
                                            	@endif
                                            @endforeach
                                        </td>
                                    </tr>
 	                       			<tr>
                        				<td @if (Auth::user()->isDm()) colspan="4" @else colspan="3" @endif>
                        					@foreach ($data['signups'] as $id => $person)
                            					<a class="{{ $person['tentative'] ? 'tentative ' : '' }}{{ $person['dm'] ? 'active dm' : 'active' }}">{{ __($person['name']) }}</a>
                            				@endforeach
                        				</td>
                                    </tr>
                        		@endforeach
                          </tbody>          
                        </table>
                    </div>
                </form>
            @endif
		</div>

    @endcomponent
    
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Rules') }}</a>
    			</div>
            </div>
    	</div>

        <div class="card-body" style="display: none;">
        	<div>
        		<p>Games usually have a start time of 7pm, jump in the voice chat a half hour before :)</p>
        		<p>Games will go ahead if there are at least one DM and 3 players</p>
        		<p>There is a usually a max of 5 players per DM</p>
   			</div>
		</div>

    @endcomponent
@endsection

	

@section('script')
    <script type="text/javascript">
    </script>
@endsection