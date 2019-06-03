<?php

namespace App\Http\Controllers;

class SessionsController extends Controller
{
    public function index()
    {
        $sessions = [
            'Session 1, April 19th',
            'Session 2, April 20th',
            'Session 3, April 21st'
        ];
        
        return view('sessions.index', compact('sessions'));
    }
}
