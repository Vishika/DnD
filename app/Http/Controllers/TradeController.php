<?php

namespace App\Http\Controllers;

use App\Character;
use App\Trade;
use App\User;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Character $character, Request $request)
    {
        $this->authorize('admin', auth()->user());
        $characters = array();
        foreach (User::all() as $selectUser)
        {
            foreach ($selectUser->characters as $selectCharacter)
            {
                // show characters as inactive, if their user is inactive
                $selectCharacter->active = ($selectUser->active) ? $selectCharacter->active : false;
                $characters[] = $selectCharacter;
            }
        }
        return view('trade.create', ['user' => $user, 'character' => $character, 'characters' => $characters]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Character $character, Request $request)
    {
        $this->authorize('admin', auth()->user());
        if (auth()->user()->isAdmin()) {
            $max = '';
        } else {
            $max = 'max:' . $character->gold;
        }
        $validated = request()->validate([
            'gold' => ['required', 'integer', 'min:1', $max],
            'note' => ['required', "regex:/^[\w .,'!?()]+$/u"],
            'character_id' => ['nullable', 'integer', 'exists:characters,id'],
        ]);
        // once we've validated the character id, the real id we want to send is of the character making the trade
        $recipient_id = $validated['character_id'];
        $validated['character_id'] = $character->id;
        
        if (!$request->filled('free'))
        {
            Trade::create($validated);
            // udpate the character
            $character->spend($validated['gold']);
            $character->save();
            // if the recipient id exists, it means gold was given to this person
            if (!empty($recipient_id))
            {
                $validated['character_id'] = $recipient_id;
                $recipient = Character::find($recipient_id);
                $recipient->earn($validated['gold']);
                $recipient->save();
                $validated['gold'] = -$validated['gold'];
                Trade::create($validated);
            }
        }
        else
        {
            $character->earn($validated['gold']);
            $character->save();
            $validated['gold'] = -$validated['gold'];
            Trade::create($validated);
        }
        
        return redirect('/user/' . $user->id . '/character/' . $character->id);
    }
}
