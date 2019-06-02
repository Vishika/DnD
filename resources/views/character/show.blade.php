@extends('layouts.app')
@section('header', $character->name)
@section('content')

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
    
	<div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <form method="GET" action="/character/{{ $character->id }}/edit">
                <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        	</form>
        </div>
    </div>
        
@endsection