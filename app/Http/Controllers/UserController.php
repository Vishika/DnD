<?php

namespace App\Http\Controllers;

use App\Registrable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        $users = User::all();
        $registrables = Registrable::all();
        return view('user.index', ['users' => $users, 'registrables' => $registrables]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('owner', $user);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('owner', $user);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('owner', $user);
        $request->merge(array('active' => $request->filled('active')));
        $validated = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
            'active' => ['boolean'],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user->update($validated);
        return redirect("/user/$user->id");
    }
}
