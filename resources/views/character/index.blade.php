@extends('layouts.app')
@section('header', 'Characters')
@section('content')

	<div class="form-group row">
        <div class="people">
            @foreach ($characters as $character)
            	<a class="{{ $character['active'] ? 'active' : 'inactive' }}" href="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}">{{ __($character['name']) }}</a>
            @endforeach
        </div>
    </div>
    
@endsection