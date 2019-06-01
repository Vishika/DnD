@extends('layout')

@section('title', 'Edit Character')

@section('content')
<form method="POST" action="/character/{{ $character->id }}">
	@csrf
	@method('PATCH')
	<ul class="wrapper">
    	<li class="form-row">
        	<label for="name">Name</label>
            <input type="text" name="name" required value="{{ $character->name }}">
        </li>
        <li class="form-row">
        	<label for="race">Race</label>
            <input type="text" name="race" required value="{{ $character->race }}">
        </li>
        <li class="form-row">
        	<label for="class">Class</label>
            <input type="text" name="class" required value="{{ $character->class }}">
        </li>
    </ul>
	<div class="button-wrapper">
    	<button type="submit">Update</button>
    </div>
</form>
<form method="POST" action="/character/{{ $character->id }}">
	@csrf
	@method('DELETE')
	<div class="button-wrapper">
    	<button type="submit">Delete</button>
    </div>
    @include('errors')
</form>
@endsection