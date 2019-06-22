@extends('layouts.app')
@section('title', 'Reset Password')
@section('page')
    @component('layouts.card')
    	@slot('header')
    		Reset Password
    	@endslot

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <p>Please contact one of the administrators on discord, they can reset your password for you.</p>
        
    @endcomponent
@endsection
