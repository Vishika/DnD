<?php

namespace App\Http\Controllers;

use App\Session;
use App\SessionCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Character;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('dm', auth()->user());
        $sessions = Session::with('sessionCharacters.character', 'user')->get();
        return view('session.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('dm', auth()->user());
        $difficulty = ['Easy' => 'easy', 'Medium' => 'medium', 'Role Play' => 'role play', 'Hard' => 'hard', 'Deadly' => 'deadly'];
        $dms = DB::table('users')->where('role', 'dm')->orWhere('role', 'admin')->get();
        $characters = Character::all()->sortByDesc('experience');
        return view('session.create', ['dms' => $dms, 'characters' => $characters, 'difficulty' => $difficulty]);
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
            'name' => ['required', 'min:3', 'max:191', 'regex:/^[\pL\s\-]+$/u', 'unique:sessions,name'],
            'created_at' => ['required', 'date_format:Y-m-d'],
            'user_id' => ['required', 'integer'],
            'duration' => ['required', 'integer', 'min:1', 'max:12'],
            'difficulty' => ['required', 'in:easy,medium,role play,hard,deadly'],
            'encounters' => ['required', 'integer', 'min:0', 'max:12'],
            'note' => ['nullable', 'string', 'max:191'],
        ]);
        $session = Session::create($validated);
        foreach ($request->character_id as $character_id)
        {
            $sessionCharacter = [
                'session_id' => $session->id,
                'character_id' => $request->character_id[$character_id],
                'difficulty' => $request->character_difficulty[$character_id],
                'duration' => $request->character_duration[$character_id],
                'encounters' => $request->character_encounters[$character_id],
                'experience' => $request->character_experience[$character_id],
                'gold' => $request->character_gold[$character_id],
                'dm' => ($request->user_id == $request->character_user_id[$character_id]),
                'note' => $request->character_note[$character_id],
                'created_at' => $request->created_at
            ];
            SessionCharacter::create($sessionCharacter);
            // udpate the character
            $character = Character::find($character_id);
            $character->addSession($request->character_experience[$character_id], $request->character_gold[$character_id]);
            $character->save();
        }
        session()->flash('message', "$request->name has been logged.");
        return redirect('/session');
    }
}
