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
    public function index(User $user)
    {
        $this->authorize('owner', $user);
        if ($user->isPlayer())
        {
            $characters = auth()->user()->characters->sortByDesc('experience');
        }
        else
        {
            $characters = Character::all()->sortByDesc('experience');
        }
        return view('character.index', compact('characters'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Character $character)
    {
        $this->authorize('access', $user);
        return view('character.show', compact('user'), compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Character $character)
    {
        $this->authorize('owner', $user);
        return view('character.edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Character $character, Request $request)
    {
        $this->authorize('owner', $user);
        if (auth()->user()->isPlayer()) {
            $validated = request()->validate($this->validateCharacter('update'));
        }
        else {
            $request->merge(array('active' => $request->filled('active')));
            $validated = request()->validate($this->validateCharacter('dm-update'));
        }
        $character->update($validated);
        session()->flash('message', "$character->name has been updated.");
        return redirect('/user/' . $user->id . '/character/' . $character->id);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Character $character, Request $request)
    {
        $this->authorize('create', $user);
        return view('character.create', compact('user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Character $character, Request $request)
    {
        $this->authorize('create', $user);
        $request->merge(array('user_id' => $user->id));
        $validated = request()->validate($this->validateCharacter('create'));
        Character::create($validated);
        session()->flash('message', "$user->name has a new character.");
        return redirect('/user/' . $user->id);
    }
    
    /**
     * Gets validator settings.
     */
    private function validateCharacter($method)
    {
        $validation = [
            'name' => ['required', 'min:3', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'race' => ['required', 'alpha_dash', 'min:3', 'max:191'],
            'class' => ['required', 'alpha_dash', 'min:3', 'max:191'],
        ];
        switch ($method)
        {
            case 'create':
                $validation['user_id'] = ['required', 'integer'];
                $validation['name'] = ['required', 'min:3', 'max:191', 'regex:/^[\pL\s\-]+$/u', 'unique:characters'];
                return $validation;
                break;

            case 'dm-update':
                $validation['active'] = ['boolean'];
                return $validation;
                break;

            case 'update':
                return $validation;
                break;
        }
    }
}
