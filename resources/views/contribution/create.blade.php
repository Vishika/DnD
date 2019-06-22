@extends('layouts.app')
@section('title', 'Contribute')
@section('page')
    @component('layouts.card')
    	@slot('header')
    		Contribute
    	@endslot

    	<form method="POST" action="/user/{{ $user->id }}/character/{{ $character->id }}/contribute">
            @csrf
        
            <div class="form-group row">
                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount (gold)') }}</label>
        
                <div class="col-md-6">
                    <input id="amount" type="number" min="1" max="{{ $character->gold }}" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>
        
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="project_id" class="col-md-4 col-form-label text-md-right">{{ __('Project') }}</label>
        
                <div class="col-md-6">
                    <select id="project_id" class="form-control  @error('project_id') is-invalid @enderror" name="project_id" required>
                    	@foreach ($projects as $project)
            				<option value="{{ $project->id }}">{{ $project->name }}</option>
            			@endforeach
            		</select>
        
                    @error('project_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">{{ __('Contribute') }}</button>
                </div>
            </div>
    	</form>

    @endcomponent
@endsection