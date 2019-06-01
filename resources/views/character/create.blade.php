@extends('layout')

@section('title', 'Create Character')

@section('content')
<form method="POST" action="/character">
	@csrf
	<input type="hidden" name="user_id" value="{{ $user_id }}">
	<ul class="wrapper">
    	<li class="form-row">
        	<label for="name">Name</label>
            <input type="text" name="name" required value="{{ old('name') }}">
        </li>
        <li class="form-row">
        	<label for="race">Race</label>
            <input type="text" name="race" required value="{{ old('race') }}">
        </li>
        <li class="form-row">
        	<label for="class">Class</label>
            <input type="text" name="class" required value="{{ old('class') }}">
        </li>
    </ul>
    <div class="button-wrapper">
    	<button type="submit">Create</button>
    </div>
    @include('errors')
</form>
@endsection