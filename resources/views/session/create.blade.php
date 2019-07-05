@extends('layouts.app')
@section('title', 'Log Session')
@section('page')
    @component('layouts.card')

    	<div class="card-header">
        	<div class="header-row">
        		<div class="mr-auto slide">
        			<a class="header-item">{{ __('Log Session') }}</a>
    			</div>
                <div class="ml-auto">
                    <button class="header-item" form="log" type="submit">{{ __('Log') }}</button>
                </div>
            </div>
    	</div>

        <div class="card-body">
        	<form id="log" method="POST" action="/session">
                @csrf
            
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Session Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
            
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Session Date') }}</label>
            
                    <div class="col-md-6">
                        <input id="created_at" type="date" class="form-control @error('created_at') is-invalid @enderror" name="created_at" value="{{ empty(old('created_at')) ? date('Y-m-d') : old('created_at') }}" required>
            
                        @error('created_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Dungeon Master') }}</label>
            
                    <div class="col-md-6">
                        <select id="user_id" class="form-control  @error('user_id') is-invalid @enderror" name="user_id" required>
                        	@foreach ($dms as $dm)
                				<option value="{{ $dm->id }}" {{ ((empty(old('user_id')) && (Auth::user()->id == $dm->id)) || (!empty(old('user_id')) && (old('user_id') == $dm->id)))? 'selected' : ''}} >{{ $dm->name }}</option>
                			@endforeach
                		</select>
            
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration (hours)') }}</label>
            
                    <div class="col-md-6">
                        <input id="duration" type="number" step="1" min="1" max="12" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ empty(old('duration')) ? 3 : old('duration') }}" required>
            
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="difficulty" class="col-md-4 col-form-label text-md-right">{{ __('Difficulty (hazard)') }}</label>
            		
                    <div class="col-md-6">
                        <select id="difficulty" class="form-control  @error('difficulty') is-invalid @enderror" name="difficulty" required>
                        	@foreach ($difficulty as $name => $value)
                            	@if (old('difficulty') == $value)
                                      <option value="{{ $value }}" selected>{{ $name }}</option>
                                @else
                                      <option value="{{ $value }}">{{ $name }}</option>
                                @endif
                            @endforeach
                		</select>
            
                        @error('difficulty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="encounters" class="col-md-4 col-form-label text-md-right">{{ __('Encounters (fights)') }}</label>
            
                    <div class="col-md-6">
                        <input id="encounters" type="number" step="1" min="0" max="12" class="form-control @error('encounters') is-invalid @enderror" name="encounters" value="{{ empty(old('encounters')) ? 3 : old('encounters') }}" required>
            
                        @error('encounters')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>
            
                    <div class="col-md-6">
                        <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}">
            
                        @error('note')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
        		 @if (Auth::user()->isAdmin())
                    <div class="form-group row">
                        <label for="xp" class="col-md-4 col-form-label text-md-right">{{ __('Experience (override)') }}</label>
                
                        <div class="col-md-6">
                            <input id="xp" type="number" class="form-control" onchange="updateXp()">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="gp" class="col-md-4 col-form-label text-md-right">{{ __('Gold (override)') }}</label>
                
                        <div class="col-md-6">
                            <input id="gp" type="number" class="form-control" onchange="updateGp()">
                        </div>
                    </div>
                @endif
                
                
                <div class="overflow">
                    <table id="charactersTable" class="table alternating fillable" ondrop="dropInTable(event)" ondragover="allowDrop(event)">
                        <thead>
                            <tr>
                            	<th>Character</th>
                            	<th>LvL</th>
                                <th>Hours</th>
                                <th>Hazard</th>
                                <th>Fights</th>
                                <th>XP</th>
                                <th>GP</th>
                                <th>Note</th>
                            </tr>
                        </thead> 
                        <tbody>
                        </tbody>          
                    </table>
                </div>
                
                <div id="info">
                    <p>Drag active characters into the table above.</p>
                    <p>Players should be rewarded by the number of encounters they completed.</p>
                    <p>When determining the difficulty try to approximate the average</p>
                    <p>An RP encounter should take roughly a half hour</p>
                </div>
                
                @if (!empty($characters))
                    <div class="form-group row" ondrop="dropInList(event)" ondragover="allowDrop(event)">
                        <div id="charactersList" class="people">
                            @foreach ($characters as $character)
                            	@if ($character->isActive())
                            		<a class="active" id="character-{{ $character['id'] }}" href="/user/{{ $character['user_id'] }}/character/{{ $character['id'] }}" draggable="true" ondragstart="drag(event)" userId="{{ $character['user_id'] }}" characterId="{{ $character['id'] }}" level="{{ $character['level'] }}">{{ __($character['name']) }}</a>
                            	@endif
                            @endforeach
                        </div>
                    </div>
                @endif
                
        	</form>
    	</div>
    	
    @endcomponent
@endsection

@section('script')
    <script type="text/javascript">
        function allowDrop(event) {
        	event.preventDefault();
        }
        
        function drag(event) {
        	event.dataTransfer.setData("text", event.target.id);
        }
    
        @if (Auth::user()->isAdmin())
            function updateXp() {
                var xp = $('#xp').val();
            	$( "input[name^='character_experience']" ).val( xp );
            }
    
            function updateGp() {
            	var gp = $('#gp').val();
            	$( "input[name^='character_gold']" ).val( gp );
            }
        @endif
        
        function dropInList(event) {
        	event.preventDefault();
        	// add the character to the list
            var charactersList = document.getElementById('charactersList');
            var character = event.dataTransfer.getData('text');
            if (document.getElementById(character)) {
            	document.getElementById(character).classList.remove('dm');
            	charactersList.appendChild(document.getElementById(character));
    			// remove the characters row from the character table
                var characterTableRowId = 'row-' + character;
                var oldCharacterTableRow = document.getElementById(characterTableRowId);
                if (oldCharacterTableRow) {
                	oldCharacterTableRow.parentNode.removeChild(oldCharacterTableRow);
                }
            }
        }
    
        function dropInTable(event) {
        	event.preventDefault();
        	var character = event.dataTransfer.getData('text');
        	// do not allow characters already in the table to be dropped in
        	if (character && character.startsWith('character-') && !($('#row-'.concat(character)).length)) {
	        	// hide the info
	        	document.getElementById('info').style.display = 'none';
	            var charactersTable = document.getElementById('charactersTable');
	            var rowCount = charactersTable.rows.length;
	            var tr = charactersTable.insertRow(rowCount);
	            // insert character draggable
	            var td = document.createElement('td');
	            td = tr.insertCell(0);
	    		td.appendChild(document.getElementById(character));
	         	// set the id of the row so we can remove it easily later
	            var nodes = td.childNodes;
	            var userId = nodes[0].getAttribute('userId');
	            if ($('#user_id').val() == userId) {
	            	document.getElementById(character).classList.add('dm');
	            }
	            var characterId = nodes[0].getAttribute('characterId');
	            var characterLevel = nodes[0].getAttribute('level');
	            var rowId = 'row-character-' + characterId;
	            tr.setAttribute('id', rowId);
	         	// add hidden fields
	    		var hidden = $('<input />', {name: 'character_id[' + characterId + ']', type: 'hidden', value: characterId});
	    		hidden.appendTo(td);
	    		var hidden = $('<input />', {name: 'character_user_id[' + characterId + ']', type: 'hidden', value: userId});
	    		hidden.appendTo(td);
	    		// insert the level
	    		var td = $('<td />');
	            var input = $('<div />', {class: 'form-control', text: characterLevel});
	            input.appendTo(td);
	            td.appendTo(tr);
	            // insert the duration input
	            var defaultValue = $('#duration').val();
	            var td = $('<td />');
	            var input = $('<input />', {name: 'character_duration[' + characterId + ']', class: 'form-control', type: 'number', step: '1', min: '0', max: '12', required: 'true', value: $('#duration').val()});
	            input.appendTo(td);
	            td.appendTo(tr);
	            // insert what the difficulty input
	            var defaultValue = $('#difficulty').val();
	            var options = {
	    			'role play': 'R',
	                'easy': 'E',
	                'medium': 'M',
	                'hard': 'H',
	                'deadly': 'D',
	            }
	            var td = $('<td />');
	            var select = $('<select />', {name: 'character_difficulty[' + characterId + ']', class: 'form-control', onchange: 'updateXpGp(\'' + rowId + '\')'});
	            for(var value in options) {
	                if (value == defaultValue) {
	                	$('<option />', {value: value, text: options[value], selected: 'selected'}).appendTo(select);
	                } else {
	                	$('<option />', {value: value, text: options[value]}).appendTo(select);
	                }
	            }
	            select.appendTo(td);
	            td.appendTo(tr);
	         	// insert the encounters input
	            var defaultValue = $('#encounters').val();
	            var td = $('<td />');
	            var input = $('<input />', {name: 'character_encounters[' + characterId + ']', class: 'form-control', type: 'number', step: '1', min: '0', max: '12', required: 'true', value: $('#encounters').val(), onchange: 'updateXpGp(\'' + rowId + '\')'});
	            input.appendTo(td);
	            td.appendTo(tr);
	         	// insert the experience input
	            var td = $('<td />');
	            var input = $('<input />', {name: 'character_experience[' + characterId + ']', class: 'form-control', type: 'number', required: 'true', value: '0'});
	            input.appendTo(td);
	            td.appendTo(tr);
	         	// insert the gold input
	            var td = $('<td />');
	            var input = $('<input />', {name: 'character_gold[' + characterId + ']', class: 'form-control', type: 'number', required: 'true', value: '0'});
	            input.appendTo(td);
	            td.appendTo(tr);
	         	// insert the note input
	         	var td = $('<td />');
	            var input = $('<input />', {name: 'character_note[' + characterId + ']', class: 'form-control', type: 'text'});
	            input.appendTo(td);
	            td.appendTo(tr);
	    		// update the gold and experience based on the encounters and difficulty
	            updateXpGp(rowId);
        	}
    	}
    
    	function updateXpGp(rowId) {
    		// get the character element
    		var characterRow = document.getElementById(rowId);
    		var level = characterRow.firstChild.firstChild.getAttribute('level');
    		var difficulty = characterRow.children[3].firstChild.value;
    		var encounters = characterRow.children[4].firstChild.value;
    		var difficultyLevelModifier = {'role play': -1, 'easy': -1, 'medium': 0, 'hard': 1, 'deadly': 2};
    		var modifiedLevel = +level + difficultyLevelModifier[difficulty];
    		var gp = +modifiedLevel * +modifiedLevel * 12;
    		var xp = {0 : 0, 1 : 50, 2 : 113, 3 : 175, 4 : 275, 5 : 450, 6 : 575, 7 : 725, 8 : 975, 9 : 1250, 10 : 1475, 11 : 1800, 12 : 2100, 13 : 2500, 14 : 2875, 15 : 3250, 16 : 3750, 17 : 4500, 18 : 5000, 19 : 5500, 20 : 6250};
    		characterRow.children[5].firstChild.value = xp[modifiedLevel] * +encounters;
    		characterRow.children[6].firstChild.value = gp * encounters;
    	}
    </script>
@endsection