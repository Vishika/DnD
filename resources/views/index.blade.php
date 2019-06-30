@extends('layouts.app')

@section('page')

	@foreach($charts['player'] as $key => $player)
    	@if (!empty($charts['player']))
        	@component('layouts.card')
        
            	<div class="card-header">
                	<div class="header-row">
                		<div class="mr-auto">
                			<a class="header-item">{{ __($key) }}</a>
            			</div>
                    </div>
            	</div>
                <div class="card">
                	<div class="fit center wrap card-body">
                		@foreach($player as $chart)
                			<div>
                				{!! $chart->container() !!}
                			</div>
            			@endforeach
                	</div>
                </div>
        
        	@endcomponent
    	@endif
	@endforeach

	@can('dm', $user)
		 @component('layouts.card')

        	<div class="card-header">
            	<div class="header-row">
            		<div class="mr-auto">
            			<a class="header-item">{{ __('Dungeon Master Overview') }}</a>
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

		@endcomponent
    @endcan

@endsection

@section('script')
	@can('dm', $user)
		@foreach($charts['player'] as $player)
    		@foreach($player as $chart)
    			{!! $chart->script() !!}
    		@endforeach
		@endforeach
		@foreach($charts['dm'] as $chart)
			{!! $chart->script() !!}
		@endforeach
	@endcan
@endsection