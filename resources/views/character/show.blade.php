@extends('layout')

@section('title', $character->name)

@section('content')
<ul class="wrapper">
    <li class="form-row">
    	<label for="name">Name</label>
        <input type="text" readonly name="name" value="{{ $character->name }}">
    </li>
    <li class="form-row">
    	<label for="race">Race</label>
        <input type="text" readonly name="race" value="{{ $character->race }}">
    </li>
    <li class="form-row">
    	<label for="class">Class</label>
        <input type="text" readonly name="class" value="{{ $character->class }}">
    </li>
    <li class="form-row">
    	<label for="gold">Gold</label>
        <input type="text" readonly name="gold" value="{{ $character->gold }}">
    </li>
    <li class="form-row">
    	<label for="experience">Experience</label>
        <input type="text" readonly name="experience" value="{{ $character->experience }}">
    </li>
    <li class="form-row">
    	<label for="level">Level</label>
        <input type="text" readonly name="level" value="{{ $character->level }}">
    </li>
</ul>
<div class="button-wrapper">
	<a class="button" href="/character/{{ $character->id }}/edit">Edit</a>
</div>
@endsection