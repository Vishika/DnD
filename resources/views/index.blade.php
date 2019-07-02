@extends('layouts.app')

@section('page')

	@foreach($data['player'] as $id => $character)
    	@if (!empty($data['player']))
        	@component('layouts.card')
        
            	<div class="card-header">
            		<div class="fit">
            			<a class="header-item title-name">{{ __($character['name']) }}</a>
            			<div class="progress-bar">
        					<span title="{{ $achievements->getNextLevelReq($id) }} experience to go." class="progress" style="width:{{ $achievements->getLevelProgress($id) }}%"></span>
                		</div>
                    </div>
            	</div>
                <div class="card">
                	<div class="fit center wrap card-body">
                		@foreach($character['charts'] as $chart)
                			@if (!empty($achievements->getAchievements($id)))
                				<div class="dashboard-item">
                    				<div class="dashboard-item-header">Achievements</div>
                    				@foreach($achievements->getAchievements($id) as $name => $achievement)
                    					<div class="fit center">
                    						<img title="{{ $achievement }}" class="achievement" src="{{ asset('images/achievements/' . $name . '.png') }}">
                    					</div>
                    				@endforeach
                				</div>
                			@endif
                			<div class="dashboard-item">
                				<div class="dashboard-item-header"></div>
                				<div>{!! $chart->container() !!}</div>
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
        			@foreach($data['dm']['charts'] as $chart)
            			<div class="dashboard-item">
            				{!! $chart->container() !!}
            			</div>
        			@endforeach
            	</div>
            </div>

		@endcomponent
    @endcan

@endsection

@section('script')
	@foreach($data['player'] as $character)
		@foreach($character['charts'] as $chart)
			{!! $chart->script() !!}
		@endforeach
	@endforeach
	@can('dm', $user)
		@foreach($data['dm']['charts'] as $chart)
			{!! $chart->script() !!}
		@endforeach
	@endcan
@endsection