@extends('layout')

@section('title', 'Create User')

@section('content')
<form method="POST" action="/user">
	@csrf
	<ul class="wrapper">
        <li class="form-row">
        	<label for="name">Name</label>
            <input type="text" name="name" required value="{{ old('name') }}">
        </li>
        <li class="form-row">
            <label for="discord_name">Discord Name</label>
            <input type="text" name=discord_name required value="{{ old('discord_name') }}">
        </li>
        <li class="form-row">
            <label for="password">Password</label>
            <input type="text" name="password" required value="{{ old('password') }}">
        </li>
        <li class="form-row">
            <label for="password">Confirm Password</label>
            <input type="text" name="password_confirmation" required>
        </li>
    </ul>
    <div class="button-wrapper">
    	<button type="submit">Create</button>
    </div>
    @include('errors')
</form>
@endsection