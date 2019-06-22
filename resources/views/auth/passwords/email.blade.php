@extends('layouts.app')
@section('title', 'Reset Password')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto">
        			<a class="header-item">{{ __('Reset Password') }}</a>
    			</div>
            </div>
    	</div>

        <div class="card-body">

            <p>Please contact one of the administrators on discord, they can reset your password for you.</p>

        </div>

    @endcomponent
@endsection
