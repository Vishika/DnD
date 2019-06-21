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
        $this->authorize('access', auth()->user());
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
        $this->authorize('access', $user);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('owner', $user);
        $action = $request->input('submit');
        if (empty($action))
        {
            $action = $request->old('submit');
        }
        switch ($action)
        {
            case 'edit':
                return view('user.edit', compact('user'));
                break;
                
            case 'edit-password':
                return view('user.edit-password', compact('user'));
                break;
        }
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
            'email' => ['nullable', 'string', 'email', 'max:191'],
            'active' => ['boolean'],
        ]);
        $user->update($validated);
        session()->flash('message', "$user->name has been updated.");
        return redirect("/user/$user->id");
    }
    
    /**
     * Update the specified password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('owner', $user);
        $validated = request()->validate([
            'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user->update($validated);
        session()->flash('message', "$user->name has had their password updated.");
        return redirect("/user/$user->id");
    }
}
