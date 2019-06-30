<?php

namespace App\Charts;

class DmBarChart extends DmChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $data = $this->dataInPercentage;
        $this->labels($data->keys());
        $chartType = 'bar';
        $this->dataset('Sessions Run %', $chartType, $data->pluck('sessions'))->options($this->getColours($this->legendary));
        $this->dataset('Encounters %', $chartType, $data->pluck('encounters'))->options($this->getColours($this->veryRare));
        $this->dataset('Hours %', $chartType, $data->pluck('duration'))->options($this->getColours($this->rare));
        $this->displayAxes(false, false);
    }
}
