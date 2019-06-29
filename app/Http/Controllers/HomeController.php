<?php

namespace App\Http\Controllers;

use App\Charts\ActivityChart;
use App\Charts\CharacterLevelChart;
use App\Charts\DmBarChart;
use App\Charts\DmDoughnutChart;

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
        if (auth()->user()->isPlayer()) {
            $charts = array();
        }
        else {
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
