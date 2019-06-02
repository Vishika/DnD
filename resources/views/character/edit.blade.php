@extends('layouts.app')
@section('header', 'Edit Character')
@section('content')

    <form method="POST" action="/character/{{ $character->id }}">
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
        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </div>
    </form>
    
@endsection