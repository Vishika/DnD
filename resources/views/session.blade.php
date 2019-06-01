@extends('layout')

@section('title', 'Sessions')

@section('content')
	<ul>
		@foreach($sessions as $session)
		<li>{{$session}}</li>
		@endforeach
	</ul>
	
@endsection