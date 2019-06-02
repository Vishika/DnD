@extends('layouts.app')
@section('header', 'Create Character')
@section('content')

	<form method="POST" action="/character">
        @csrf
        
        <input type="hidden" name="user_id" value="{{ $user_id }}">
    
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
        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </div>
	</form>        
    
@endsection