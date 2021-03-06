<?php

namespace App\Http\Controllers;

use App\Registrable;
use Illuminate\Http\Request;

class RegistrableController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('dm', auth()->user());
        return view('registrable.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('dm', auth()->user());
        $validated = request()->validate([
            'discord_name' => ['required', 'string', 'min:3', 'max:191', 'regex:/.*#\d{4}\b/i', 'unique:users', 'unique:registrables'],
        ]);
        Registrable::create($validated);
        session()->flash('message', "$request->discord_name is now able to register.");
        return redirect("/user");
    }
}
