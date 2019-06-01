@extends('layout')

@section('title', 'Users')

@section('content')
<div class="button-wrapper">
	@foreach ($users as $user)
    <a class="button {{ $user->active ? 'active' : 'inactive' }}" href="/user/{{ $user->id }}">{{ $user->name }}</a>
	@endforeach
	<a class="button" href="/user/create">New User</a>
</div>
@endsection