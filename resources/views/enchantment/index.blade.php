@extends('layouts.app')
@section('title', 'Enchantments')
@section('page')
	@component('layouts.card')
    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Enchanting rules') }}</a>
    			</div>
            </div>
    	</div>
    
        <div class="card-body" style="display: none;">
        	<div>
        		<p>Multiple enchantments can be added to a single "type" of item following these rules:</p>
        		<ul>
        			<li>Enchantments are not of the same rarity.</li>
        			<li>More common enchantments are added before rarer ones.</li>
        			<li>Enchantments follow the restrictions they may come with (hover over the descriptions to see restrictions).</li>
        		</ul>
        		<p>Attunement</p>
        		<ul>
        			<li>Enchantments of rare or higher cause the item to require attunement.</li>
        			<li>Items enchanted holding a rare or rarer enchantment require attunement and become soul bound to the first person that touches them. A soul bound items magic is bound to your soul. If lost soul bound items are able to be summoned to you with the help of someone proficient in arcana. Another persons soul bound item acts at most as an uncommon enchantment.</li>
        			<li>Class restrictions require a character to be purely of one class, multiclassing will break and prevent attunement.</li>
        		</ul>
        		<p>FAQ</p>
        		<ul>
        			<li>Do I have to pay for the item? Yes, these enchantments are in addition to the base cost of the item, eg full plate is still 1500gp.</li>
        			<li>Do magical items take damage? Yes, they can even be destroyed, but they slowly repair over time.</li>
        			<li>Will they fit me? Probably, Items can grow or shrink to suit a small or medium humanoid.</li>
        			<li>Anything else? Unfortunately, legendary or powerful monsters may be immune to some effects of enchantments like crit effects.</li>
        		</ul>
        		<p>Performing an Enchantment, Disenchantment or an Enchanted item summoning</p>
        		<ul>
        			<li>Only spell casters proficient in arcana can enchant, they can perform enchantments based on their level of proficiency.</li>
        			<li>To be able to perform an enchantment of a certain rarity you must also have the required proficency bonus in arcana as indicated by 'Prof' in the table below. Expertize adds only one to your proficiency in terms of using this.</li>
        			<li>Enchanting, Disenchanting or Summoning enchanted items takes 2 days if the enchanter succeeds the arcana check.</li>
        			<li>The DC is based on the enchantments rarity. For each multiple of 5 higher than the DC that you reach the time is halved. Failure doubles the enchanting time and for each multiple of 5 lower than the DC the time is doubled.</li>
        			<li>When disenchanting an enchanted item, you can only obtain their common and uncommon enchantments, the rest are lost. The energy captured is put into a glass orb called a mertia.</li>
        		</ul>
        		<div class="fit center">
        			<div class="overflow">
                		<table class="table bg-light right">
                			<tr>
        						<th class="left">Rarity</th>
        						<th>Prof</th>
        						<th>DC</th>
        						<th>Price</th>
        					</tr>
            				<tr class="common">
                                <td class="left">Common</td>
                                <td>+2</td>
                                <td>5</td>
                                <td>500</td>
        					</tr>
        					<tr class="uncommon">
                                <td class="left">Uncommon</td>
                                <td>+3</td>
                                <td>10</td>
                                <td>2,500</td>
        					</tr>
        					<tr class="rare">
                                <td class="left">Rare</td>
                                <td>+4</td>
                                <td>15</td>
                                <td>7,000</td>
        					</tr>
        					<tr class="very rare">
                                <td class="left">Very Rare</td>
                                <td>+5</td>
                                <td>20</td>
                                <td>20,000</td>
        					</tr>
        					<tr class="legendary">
                                <td class="left">Legendary</td>
                                <td>+6</td>
                                <td>25</td>
                                <td>40,000</td>
        					</tr>
        				</table>
					</div>
        		</div>
   			</div>
		</div>
    @endcomponent

	@foreach($enchantments->pluck('type')->unique() as $type)
		@component('layouts.card')
        	<div class="card-header">
            	<div class="header-row">
            		<div class="mr-auto slide">
            			<a class="header-item">{{ __(ucfirst($type) . ' Enchantments') }}</a>
        			</div>
                </div>
        	</div>
        
            <div class="card-body" style="display: none;">
            	<div class="overflow">
                	<table class="table alternating">
                        	@foreach ($enchantments->where('type', $type) as $enchantment)
                				<tr>
                                    <td class="fit" title="{{ $enchantment->rarity }}">
                                    	<a class="rarity {{ $enchantment->rarity }}">{{ $enchantment->name }}</a>
                                    	<div class="slide-enchantment rarity">{{ $enchantment->brief_description }}</div>
                                	</td>
                				</tr>
                				<tr title="{{ $enchantment->restrictions }}" style="display: none;">
                                    <td colspan="1">{{ $enchantment->long_description }}</td>
                				</tr>
        					@endforeach
                        <tbody>
                        </tbody>          
                	</table>
                </div>
        	</div>
        @endcomponent
	@endforeach
@endsection

@section('script')
    <script type="text/javascript">
        $(".slide-enchantment").click(function() {
            $(this).parent().parent().next().slideToggle("slow");
        });
    </script>
@endsection