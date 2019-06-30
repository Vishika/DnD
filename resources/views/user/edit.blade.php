@extends('layouts.app')
@section('title', 'Edit User')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Edit User') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="edit-user" type="submit">{{ __('Update') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
            <form id="edit-user" method="POST" action="/user/{{ $user->id }}">
            	@csrf
            	@method('PATCH')
            	<input type="hidden" name="submit" value="edit">
            	
            	 <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
            
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            	
            	<div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
            
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="active" id="active" {{ $user->active ? 'checked' : '' }}>
            
                            <label class="form-check-label" for="active">{{ __('Active') }}</label>
                             
                             @error('active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </form>
    	</div>

    @endcomponent
@endsection