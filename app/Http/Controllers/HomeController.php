<?php

namespace App\Http\Controllers;

use App\Charts\ActivityChart;
use App\Charts\CharacterLevelChart;
use App\Charts\DmBarChart;
use App\Charts\DmDoughnutChart;
use App\Charts\PartyBarChart;
use App\Charts\PartyDoughnutChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $charts['player'] = array();
        foreach (auth()->user()->characters as $character) {
            if ($character->active) {
                $charts['player'][$character->name][] = new PartyBarChart($character);
                $charts['player'][$character->name][] = new PartyDoughnutChart($character);
            }
        }
        if (!auth()->user()->isPlayer()) {
            $charts['dm'] = [
                'dmBar' => new DmBarChart(),
                'dmDoughnut' => new DmDoughnutChart(),
                'characterLevelChart' => new CharacterLevelChart(),
                'activityChart' => new ActivityChart(),
            ];
        }
        return view('index', ['user' => auth()->user(), 'charts' => $charts]);
    }
}
