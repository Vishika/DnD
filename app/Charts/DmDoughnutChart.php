<?php

namespace App\Charts;

class DmDoughnutChart extends DmChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $data = $this->dataInIntegers;
        $this->labels($data->keys());
        $chartType = 'doughnut';
        $this->dataset('Sessions Run', $chartType, $data->pluck('sessions'))->options($this->getRainbowColours());
        $this->dataset('Encounters', $chartType, $data->pluck('encounters'))->options($this->getRainbowColours());
        $this->dataset('Hours', $chartType, $data->pluck('duration'))->options($this->getRainbowColours());
        $this->dataset('Kills', $chartType, $data->pluck('kills'))->options($this->getRainbowColours());
        $this->displayAxes(false, false);
    }
}
