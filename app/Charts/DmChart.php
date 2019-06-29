<?php

namespace App\Charts;

use App\Session;

class DmChart extends DndChart
{
    protected $dataInIntegers;
    protected $dataInPercentage;
    
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $sessions = Session::all();
        $data = null;
        $percentages = null;
        foreach ($sessions->pluck('user.name')->unique() as $dm) {
            $data[$dm]= ['sessions' => 0, 'duration' => 0, 'encounters' => 0, 'kills' => 0];
        }
        $total = ['sessions' => 0, 'duration' => 0, 'encounters' => 0, 'kills' => 0];
        foreach ($sessions as $session) {
            $data[$session->user->name]['sessions']++;
            $data[$session->user->name]['duration'] += $session->duration;
            $data[$session->user->name]['encounters'] += $session->encounters;
            $total['sessions']++;
            $total['duration'] += $session->duration;
            $total['encounters'] += $session->encounters;
            foreach ($session->sessionCharacters as $characterSession) {
                if (strtolower(trim($characterSession->note)) == 'death') {
                    $data[$session->user->name]['kills']++;
                    $total['kills']++;
                }
            }
        }
        $data = collect($data)->sortBy('sessions')->reverse();
        foreach ($data as $dm => $metrics) {
            foreach ($metrics as $metric => $value) {
                $percentages[$dm][$metric] = round($value / $total[$metric]* 100);
            }
        }
        $this->dataInIntegers = $data;
        $this->dataInPercentage = collect($percentages);
    }
}
