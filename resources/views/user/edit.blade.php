@extends('layout')

@section('title', 'Edit User')

@section('content')
<form method="POST" action="/user/{{ $user->id }}">
	@csrf
	@method('PATCH')
	<ul class="wrapper">
        <li class="form-row">
        	<label for="name">Name</label>
            <input type="text" name="name" required value="{{ $user->name }}">
        </li>
        <li class="form-row">
            <label for="password">Password</label>
            <input type="text" name="password" required value="{{ $user->password }}">
        </li>
        <li class="form-row">
            <label for="password">Confirm Password</label>
            <input type="text" name="password_confirmation" required>
        </li>
	</ul>
	<div class="button-wrapper">
    	<button type="submit">Update</button>
    </div>
</form>
<form method="POST" action="/user/{{ $user->id }}">
	@csrf
	@method('DELETE')
	<div class="button-wrapper">
    	<button type="submit">Delete</button>
    </div>
    @include('errors')
</form>
@endsection