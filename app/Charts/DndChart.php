<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

abstract class DndChart extends Chart
{
    protected $common = '#d9d9d9';
    protected $uncommon = '#d9ead3';
    protected $rare = '#cfe2f3';
    protected $veryRare = '#d9d2e9';
    protected $legendary = '#fce5cd';
    protected $grey = '#343a40';
    protected $black = '#181b1e';
    protected $white = '#ffffff';
    protected $red = '#7E2020';
    protected $red1 = '#C53131';
    protected $red2 = '#DA7B7B';
    protected $red3 = '#E7ABAB';
    protected $red4 = '#EFC9C9';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function getRainbowColours() {
        return [
            'backgroundColor' => [
                $this->legendary,
                $this->veryRare,
                $this->rare,
                $this->uncommon,
            ]
        ];
    }
    
    protected function getBloodColours() {
        return [
            'backgroundColor' => [
                $this->red,
                $this->red1,
                $this->red2,
                $this->red3,
                $this->red4,
            ]
        ];
    }
    
    protected function getColours($colour) {
        $colours['backgroundColor'] = $colour;
        return $colours;
    }
}
    