<?php

namespace App\Http\Controllers;

use App\Character;
use App\SessionCharacter;

class Achievements
{
    protected $characters;
    
    protected $experience = ['name' => 'experience', 'verb' => 'gained'];
    protected $hours = ['name' => 'hours', 'verb' => 'spent'];
    protected $treasure = ['name' => 'treasure', 'verb' => 'gained'];
    protected $comrades = ['name' => 'comrades', 'verb' => 'adventured with'];
    protected $level = ['name' => 'level', 'verb' => 'achieved'];
    protected $encounters = ['name' => 'encounters', 'verb' => 'resolved'];
    
    protected $tiers = [
        1 => ['place' => 'first', 'metal' => 'gold'],
        2 => ['place' => 'second', 'metal' => 'silver'],
        3 => ['place' => 'third', 'metal' => 'copper'],
    ];
    
    public function __construct()
    {
        $characters = array();
        foreach (Character::all() as $character) {
            $characters[$character->id]['id'] = $character->id;
            $characters[$character->id]['name'] = $character->name;
            $characters[$character->id][$this->level['name']] = $character->level;
            $characters[$character->id][$this->experience['name']] = $character->experience;
            $characters[$character->id][$this->treasure['name']] = 0;
            $characters[$character->id][$this->hours['name']] = 0;
            $characters[$character->id]['encounters'] = 0;
            $characters[$character->id]['sessions'] = 0;
            $characters[$character->id]['comrades'] = array();
            $characters[$character->id]['achievements'] = array();
            $characters[$character->id]['progress'] = $character->experienceProgress();
            $characters[$character->id]['levelup'] = $character->experienceRequiredForNextLevel();
        }
        foreach (SessionCharacter::all() as $session) {
            if (!$session->dm) {
                $characters[$session->character_id]['sessions']++;
                $characters[$session->character_id][$this->treasure['name']] += $session->gold;
                $characters[$session->character_id][$this->hours['name']] += $session->duration;
                $characters[$session->character_id][$this->encounters['name']] += $session->encounters;
            }
        }
        $this->characters = $characters;
        $this->addAchievement($this->experience);
        $this->addAchievement($this->treasure);
        $this->addAchievement($this->hours);
    }
    
    public function getAchievements($id) {
        return $this->characters[$id]['achievements'];
    }

    public function getLevelProgress($id) {
        return $this->characters[$id]['progress'];
    }

    public function getNextLevelReq($id) {
        return $this->characters[$id]['levelup'];
    }

    private function addAchievement($type) {
        if (!empty($this->characters)) {
            $ordered = collect($this->characters)->sortByDesc($type['name'])->groupBy($type['name']);
            for ($i = 1; $i <= 3; $i++) {
                $this->addAchievementToCharacter($i, $type, $ordered->shift());
            }
        }
    }
    
    private function addAchievementToCharacter($iteration, $type, $characters) {
        $equal = (sizeof($characters) > 1) ? 'equal' : 'place';
        foreach ($characters as $character) {
            $achievement = $this->tiers[$iteration]['metal'] . '-' . $type['name'];
            $text = 'You are ' . $this->tiers[$iteration]['place'] . ' ' . $equal . ' in terms of ' . $type['name'] . ' ' . $type['verb'] . '!';
            $this->characters[$character['id']]['achievements'][$achievement] = $text;
        }
    }
}