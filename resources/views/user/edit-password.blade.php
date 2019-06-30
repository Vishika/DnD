@extends('layouts.app')
@section('title', 'Edit User')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Change Password') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="edit-password" type="submit">{{ __('Update') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
            <form id="edit-password" method="POST" action="/user/{{ $user->id }}/password">
            	@csrf
            	@method('PATCH')
            	<input type="hidden" name="submit" value="edit-password">
                
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

            </form>
		</div>

    @endcomponent
@endsection