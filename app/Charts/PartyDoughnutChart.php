<?php

namespace App\Charts;

class PartyDoughnutChart extends PartyChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($playersCharacter)
    {
        parent::__construct($playersCharacter);
        $data = $this->dataInIntegers;
        $this->labels($data->pluck('name'));
        $chartType = 'doughnut';
        $this->dataset('Adventures %', $chartType, $data->pluck('played'))->options($this->getBloodColours());
        $this->dataset('Experience %', $chartType, $data->pluck('experience'))->options($this->getBloodColours());
        $this->dataset('Gold %', $chartType, $data->pluck('gold'))->options($this->getBloodColours());
        $this->minimalist(true);
    }
}
