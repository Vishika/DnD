@extends('layout')

@section('title', $user->name)

@section('content')
<ul class="wrapper">
    <li class="form-row">
    	<label for="name">Name</label>
        <input type="text" readonly name="name" value="{{ $user->name }}">
    </li>
    <li class="form-row">
        <label for="discord_name">Discord Name</label>
        <input type="text" readonly name=discord_name value="{{ $user->discord_name }}">
    </li>
    <li class="form-row">
        <label for="password">Password</label>
        <input type="text" readonly name="password" value="{{ $user->password }}">
    </li>
</ul>
<div class="button-wrapper">
	<a class="button" href="/user/{{ $user->id }}/edit">Edit</a>
	@foreach ($user->characters as $character)
    <a class="button {{ $character->active ? 'active' : 'inactive' }}" href="/character/{{ $character->id }}">{{ $character->name }}</a>
	@endforeach
	<form method="POST" action="/character/create">
		@method('GET')
		@csrf
		<input type="hidden" name="user_id" value="{{ $user->id }}">
		<button type="submit">New Char</button>
	</form>
</div>
@endsection