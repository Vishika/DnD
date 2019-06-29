<?php

namespace App\Charts;

use App\Character;

class CharacterLevelChart extends DndChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $characters = Character::all();
        $active = array();
        $inactive = array();
        for ($i = 1; $i <= 20; $i++) {
            $active[$i] = 0;
            $inactive[$i] = 0;
        }
        foreach ($characters as $character) {
            if ($character->isActive()) {
                $active[$character->level]++;
            } else {
                $inactive[$character->level]++;
            }
        }
        $inactive = collect($inactive);
        $active = collect($active);
        $this->labels($active->keys());
        $options = [];
        $options['backgroundColor'] = $this->common;
        $this->dataset('Inactive', 'bar', $inactive->values())->options($options);
        $options['backgroundColor'] = $this->uncommon;
        $this->dataset('Active', 'bar', $active->values())->options($options);
        $options['scales']['xAxes'][]['stacked'] = true;
        $options['scales']['yAxes'][]['stacked'] = true;
        $this->options($options);
        $this->displayAxes(false, false);
    }
}
