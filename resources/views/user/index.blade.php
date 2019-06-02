@extends('layouts.app')
@section('header', 'Users')
@section('content')

    <div class="form-group row">
		<div class="people">
            @foreach ($users as $user)
            	<a class="button {{ $user->active ? 'active' : 'inactive' }}" href="/user/{{ $user->id }}">{{ $user->name }}</a>
            @endforeach
    	</div>
    </div>
    
    <div class="form-group row">
        <div class="col-md-6">
            <form method="GET" action="/user/create">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Register User') }}</button>
        	</form>
        </div>
    </div>
    
@endsection