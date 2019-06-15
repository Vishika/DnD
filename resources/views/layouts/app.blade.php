@extends('layouts.nav')

@section('page')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">@yield('header')</div>
                <div class="card-body">
                	@yield('content')
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                    	<ul>
                    		@foreach ($errors->all() as $error)
                    			<li>{{ $error }}</li>
                    		@endforeach
                    	</ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
                