<?php

namespace App\Charts;

use App\Session;
use Illuminate\Support\Carbon;

class ActivityChart extends DndChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $sessions = Session::all();
        $data = array();
        $tomorrow = Carbon::now()->addDay(1);
        foreach ($sessions as $session) {
            $month = $session->created_at->englishMonth;
            if ($session->created_at->diffInMonths($tomorrow) < 6) {
                if (array_key_exists($month, $data)) {
                    $data[$month] += $session->sessionCharacters()->count();
                } else {
                    $data[$month] = $session->sessionCharacters()->count();
                }
            }
        }
        $data = collect($data);
        $this->labels($data->keys());
        $this->dataset('Participation', 'bar', $data->values(), $this->getColours($this->uncommon));
        $this->minimalist(true);
    }
}
