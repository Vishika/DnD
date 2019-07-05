<?php

namespace App\Http\Controllers;

use App\Character;
use App\Signup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $days = $this->getDays();
        $characters = Character::all()->keyBy('id');
        $users = User::all()->keyBy('id');
        foreach (Signup::all() as $signup) {
            if (array_key_exists($signup->date, $days)) {
                if ($signup->user_id == $user->id) {
                    // this sign up is by the user
                    $days[$signup->date]['tentative'] = boolval($signup->tentative);
                    $days[$signup->date]['dm'] = boolval($signup->dm);
                    if ($signup->character_id) {
                        $days[$signup->date]['who'][$signup->character_id]['name'] = $characters->get($signup->character_id)->name;
                        $days[$signup->date]['who'][$signup->character_id]['tentative'] = boolval($signup->tentative);
                        $days[$signup->date]['who'][$signup->character_id]['dm'] = boolval($signup->dm);
                    }
                }
                // add either the character or the user to the signups list which contains everyone
                if ($signup->character_id) {
                    $days[$signup->date]['signups'][$signup->character_id]['name'] = $characters->get($signup->character_id)->name;
                    $days[$signup->date]['signups'][$signup->character_id]['tentative'] = boolval($signup->tentative);
                    $days[$signup->date]['signups'][$signup->character_id]['dm'] = boolval($signup->dm);
                } else {
                    $days[$signup->date]['signups']['user-' . $signup->user_id]['name'] = $users->get($signup->user_id)->name;
                    $days[$signup->date]['signups']['user-' . $signup->user_id]['tentative'] = boolval($signup->tentative);
                    $days[$signup->date]['signups']['user-' . $signup->user_id]['dm'] = boolval($signup->dm);
                }
            }
        }
        return view('signup.index', ['user' => $user, 'days' => $days]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $isDm = Auth::user()->isDm();
        $characterIds = Auth::user()->characters()->pluck('id');
        // delete all entries for the user first
        DB::table('signups')->where('user_id', $userId)->delete();
        foreach ($this->getDays() as $day => $data) {
            // see what the user has input
            $tentative = ($request->exists('tentative') && array_key_exists($day, $request->tentative));
            $dm = ($request->exists('dm') && array_key_exists($day, $request->dm));
            $whom = $request->exists('whom') && array_key_exists($day, $request->whom);
            if (($tentative || $dm) && !$whom) {
                // this means they want to sign up, but don't care with whom they do it
                $signup = [
                    'date' => $day,
                    'user_id' => $userId,
                    'tentative' => $tentative,
                    'dm' => ($isDm) ? $dm : false,
                ];
                Signup::create($signup);
            } else if ($whom) {
                // this may mean they want one or more characters to be signed up
                foreach ($request->whom[$day] as $characterId) {
                    if ($characterIds->contains($characterId)) {
                        $signup = [
                            'date' => $day,
                            'user_id' => $userId,
                            'character_id' => $characterId,
                            'tentative' => $tentative,
                            'dm' => ($isDm) ? $dm : false,
                        ];
                        Signup::create($signup);
                    }
                }
            }
        }
        session()->flash('message', "Your signups have been saved.");
        return redirect('/signup');
    }
    
    private function getDays()
    {
        $days = array();
        for ($i = 0; $i < 10; $i++) {
            $date = Carbon::now()->addDays($i);
            $formattedDate = $date->format('d/m/Y');
            $days[$formattedDate]['date'] = $date;
            $days[$formattedDate]['tentative'] = false;
            $days[$formattedDate]['dm'] = false;
            $days[$formattedDate]['who'] = array();
            $days[$formattedDate]['signups'] = array();
        }
        return $days;
    }
}
