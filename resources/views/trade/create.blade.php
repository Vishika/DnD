@extends('layouts.app')
@section('title', 'Trade')
@section('page')
    @component('layouts.card')
    	@slot('header')
    		Trade
    	@endslot

    	<form method="POST" action="/user/{{ $user->id }}/character/{{ $character->id }}/trade">
            @csrf
        
            <div class="form-group row">
                <label for="gold" class="col-md-4 col-form-label text-md-right">{{ __('Amount (gold)') }}</label>
        
                <div class="col-md-6">
                    <input id="gold" type="number" min="1"  @if (!Auth::user()->isAdmin()) max="{{ $character->gold }}" @endif class="form-control @error('gold') is-invalid @enderror" name="gold" value="{{ old('gold') }}" required>
        
                    @error('gold')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>
        
                <div class="col-md-6">
                    <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note" required>{{ old('note') }}</textarea>
        
                    @error('note')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="character_id" class="col-md-4 col-form-label text-md-right">{{ __('Character') }}</label>
        
                <div class="col-md-6">
                    <select id="character_id" title="Use if giving gold to another character" class="form-control  @error('character_id') is-invalid @enderror" name="character_id">
                		<option value="" {{ (!empty(old('character_id'))) ? 'selected' : ''}} >N/A</option>
                    	@foreach ($characters as $char)
                    		@if ($char->isActive())
            					<option value="{{ $char->id }}" {{ (!empty(old('character_id'))) ? 'selected' : ''}} >{{ $char->name }}</option>
    						@endif
            			@endforeach
            		</select>
        
                    @error('character_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="give" id="give" {{ old('give') ? 'checked' : '' }}>
        
                        <label class="form-check-label" for="give">{{ __('Give the character this amount for free') }}</label>
                        
                         @error('give')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('Trade') }}</button>
                </div>
            </div>
    	</form>

    @endcomponent
@endsection