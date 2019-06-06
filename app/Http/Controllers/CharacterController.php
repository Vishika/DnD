<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;
use App\User;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isPlayer())
        {
            $characters = auth()->user()->characters;
        }
        else
        {
            foreach (User::all() as $user)
            {
                foreach ($user->characters as $character)
                {
                    // show characters as inactive, if their user is inactive
                    $character->active = ($user->active) ? $character->active : false;
                    $characters[] = $character;
                }
            }
        }
        return view('character.index', compact('characters'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        $this->authorize('owner', $character);
        return view('character.show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        $this->authorize('owner', $character);
        return view('character.edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        $this->authorize('owner', $character);
        if (auth()->user()->isPlayer()) {
            $validated = request()->validate([
                'name' => ['required', 'string', 'min:3', 'max:191'],
                'race' => ['required', 'string', 'min:3', 'max:191'],
                'class' => ['required', 'string', 'min:3', 'max:191'],
            ]);
        } else {
            $request->merge(array('active' => $request->filled('active')));
            $validated = request()->validate([
                'name' => ['required', 'string', 'min:3', 'max:191'],
                'race' => ['required', 'string', 'min:3', 'max:191'],
                'class' => ['required', 'string', 'min:3', 'max:191'],
                'active' => ['boolean'],
            ]);
        }
        $character->update($validated);
        return redirect('/character/' . $character->id);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_unless($this->can_create($request->user_id), 403);
        $user_id = $request->user_id;
        return view('character.create', compact('user_id'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless($this->can_create($request->user_id), 403);
        $validated = request()->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:191', 'unique:users'],
            'race' => ['required', 'string', 'min:3', 'max:191'],
            'class' => ['required', 'string', 'min:3', 'max:191'],
        ]);
        Character::create($validated);
        return redirect("/user/" . request()->user_id);
    }
    
    /**
     * For some reason character policies weren't working. This is a work around.
     * 
     * @param String $user_id
     * @return boolean
     */
    private function can_create($user_id) {
        $user = auth()->user();
        $user_is_owner = $user->id == $user_id;
        $user_has_not_reached_character_max = !$user->reachedCharacterLimit();
        return $user->isAdmin() || ($user_is_owner && $user_has_not_reached_character_max);
    }
}
