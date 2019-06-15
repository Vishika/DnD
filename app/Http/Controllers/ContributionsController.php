<?php

namespace App\Http\Controllers;

use App\Character;
use App\Contribution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Character $character, Request $request)
    {
        $this->authorize('contribute', $user);
        $projects = DB::table('causes')->join('projects', 'causes.id', '=', 'projects.cause_id')->where('active', 1)->get();
        return view('contribution.create', ['user' => $user, 'character' => $character, 'projects' => $projects]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Character $character, Request $request)
    {
        $this->authorize('contribute', $user);
        $max = 'max:' . $character->gold;
        $request->merge(array('character_id' => $character->id));
        $validated = request()->validate([
            'project_id' => ['required', 'integer'],
            'character_id' => ['required', 'integer'],
            'amount' => ['required', 'integer', 'min:1', $max],
        ]);
        Contribution::create($validated);
        // udpate the character
        $character = Character::find($character->id);
        $character->spendToGainExperience($request->amount);
        $character->save();
        return redirect('/user/' . $user->id . '/character/' . $character->id);
    }
}
