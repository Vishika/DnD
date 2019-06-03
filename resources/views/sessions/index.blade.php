@extends('layouts.app')
@section('header', 'Sessions')
@section('content')

	<ul>
		@foreach ($sessions as $session)
		<li>{{$session}}</li>
		@endforeach
	</ul>
	
@endsection