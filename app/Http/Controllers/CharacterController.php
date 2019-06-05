<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * auth()->user()
         * auth()->check()
         * auth()->guest()
         * auth()->id()
         */
        // TODO policy
        $characters = Character::where('user_id', auth()->id())->get();
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
        $request->merge(array('active' => $request->filled('active')));
        $validated = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:191'],
            'race' => ['required', 'string', 'min:3', 'max:191'],
            'class' => ['required', 'string', 'min:3', 'max:191'],
            'active' => ['boolean'],
        ]);
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
        $this->authorize('owner', $request->user_id);
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
        $this->authorize('owner', $request->user_id);
        $validated = request()->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:191', 'unique:users'],
            'race' => ['required', 'string', 'min:3', 'max:191'],
            'class' => ['required', 'string', 'min:3', 'max:191'],
        ]);
        Character::create($validated);
        return redirect("/user/" . request()->user_id);
    }
}
