@extends('layouts.app')

@section('page')

	@can('dm', $user)
    	<div class="container py-6">
            <div class="row justify-content-center">
                <div class="col-md-8">
                	<div class="card-header">
                    	<div class="header-row">
                    		<div class="mr-auto">
                    			<a class="header-item">{{ __('Overview') }}</a>
                			</div>
                        </div>
                	</div>
                    <div class="card">
                    	<div class="fit center wrap card-body bg-white">
                			@foreach($charts['dm'] as $chart)
                			<div>
                				{!! $chart->container() !!}
                			</div>
                			@endforeach
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection

@section('script')
	@can('dm', $user)
		@foreach($charts['dm'] as $chart)
			{!! $chart->script() !!}
		@endforeach
	@endcan
@endsection