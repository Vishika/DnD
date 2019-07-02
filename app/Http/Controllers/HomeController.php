<?php

namespace App\Http\Controllers;

use App\Charts\ActivityChart;
use App\Charts\CharacterLevelChart;
use App\Charts\DmBarChart;
use App\Charts\DmDoughnutChart;
use App\Charts\PartyChart;

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
        $data['player'] = array();
        $achievements = new Achievements();
        foreach (auth()->user()->characters as $character) {
            if ($character->active) {
                $data['player'][$character->id]['charts'][] = new PartyChart($character);
                $data['player'][$character->id]['name'] = $character->name;
            }
        }
        if (!auth()->user()->isPlayer()) {
            $data['dm']['charts'] = [
                'dmBar' => new DmBarChart(),
                'dmDoughnut' => new DmDoughnutChart(),
                'characterLevelChart' => new CharacterLevelChart(),
                'activityChart' => new ActivityChart(),
            ];
        }
        return view('index', ['user' => auth()->user(), 'data' => $data, 'achievements' => $achievements]);
    }
}
