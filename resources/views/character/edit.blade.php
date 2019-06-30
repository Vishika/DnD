@extends('layouts.app')
@section('title', 'Edit Character')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Edit Character') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="edit-character" type="submit">{{ __('Update') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
            <form id="edit-character" method="POST" action="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}">
            	@csrf
            	@method('PATCH')
            	
            	<div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $character->name }}" required autofocus>
            
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                <label for="race" class="col-md-4 col-form-label text-md-right">{{ __('Race') }}</label>
        
                    <div class="col-md-6">
                        <input id="race" type="text" class="form-control @error('race') is-invalid @enderror" name="race" value="{{ $character->race }}" required>
            
                        @error('race')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>
        
                    <div class="col-md-6">
                        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ $character->class }}" required>
            
                        @error('class')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                @if (Auth::user()->isAdmin() || Auth::user()->isDm())
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="active" id="active" {{ $character->active ? 'checked' : '' }}>
                
                                <label class="form-check-label" for="active">{{ __('Active') }}</label>
                                
                                 @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                
            </form>
    	</div>

    @endcomponent
@endsection