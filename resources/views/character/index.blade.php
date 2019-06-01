@extends('layout')

@section('title', 'Characters')

@section('content')
<div class="button-wrapper">
	@foreach ($characters as $character)
    <a class="button {{ $character->active ? 'active' : 'inactive' }}" href="/character/{{ $character->id }}">{{ $character->name }}</a>
	@endforeach
</div>
@endsection