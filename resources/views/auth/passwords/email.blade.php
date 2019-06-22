@extends('layouts.app')
@section('header', 'Reset Password')
@section('page')
    @component('layouts.card')

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <p>Please contact one of the administrators on discord, they can reset your password for you.</p>
        
    @endcomponent
@endsection
