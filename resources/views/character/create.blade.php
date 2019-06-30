@extends('layouts.app')
@section('title', 'Create Character')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Create Character') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="create-character" type="submit">{{ __('Create') }}</button>
                </div>
            </div>
    	</div>

    	<div class="card-body">
        	<form id="create-character" method="POST" action="/user/{{ $user->id }}/character">
                @csrf
            
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
            
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
                        <input id="race" type="text" class="form-control @error('race') is-invalid @enderror" name="race" value="{{ old('race') }}" required>
            
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
                        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required>
            
                        @error('class')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

        	</form>
		</div>

    @endcomponent
@endsection