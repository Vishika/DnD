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
    
    protected function getColours($colour) {
        $colours['backgroundColor'] = $colour;
        return $colours;
    }
}
    