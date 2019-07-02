<?php

namespace App\Http\Controllers;

use App\Character;
use App\Session;

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
    
    protected $achievements = array();
    
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
            $characters[$character->id][$this->comrades['name']] = array();
            $characters[$character->id]['achievements'] = array();
            $characters[$character->id]['progress'] = $character->experienceProgress();
            $characters[$character->id]['levelup'] = $character->experienceRequiredForNextLevel();
        }
        foreach (Session::all() as $session) {
            $sessionParty = array();
            foreach ($session->sessionCharacters as $sessionCharacter) {
                if (!$sessionCharacter->dm) {
                    $sessionParty[] = $sessionCharacter->character_id;
                    $characters[$sessionCharacter->character_id]['sessions']++;
                    $characters[$sessionCharacter->character_id][$this->treasure['name']] += $sessionCharacter->gold;
                    $characters[$sessionCharacter->character_id][$this->hours['name']] += $sessionCharacter->duration;
                    $characters[$sessionCharacter->character_id][$this->encounters['name']] += $sessionCharacter->encounters;
                }
            }
            foreach ($sessionParty as $characterId) {
                $characters[$characterId][$this->comrades['name']] = array_unique(array_merge($characters[$characterId]['comrades'], $sessionParty));
            }
        }
        foreach ($characters as $id => $character) {
            $characters[$id][$this->comrades['name']] = count($character[$this->comrades['name']]);
        }
        $this->characters = $characters;
        $this->addAchievement($this->experience);
        $this->addAchievement($this->treasure);
        $this->addAchievement($this->hours);
        $this->addAchievement($this->comrades);
    }
    
    public function getAllAchievements() {
        return $this->achievements;
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
        if (!empty($characters)) {
            $equal = (sizeof($characters) > 1) ? 'equal ' : '';
            foreach ($characters as $character) {
                $achievement = $this->tiers[$iteration]['metal'] . '-' . $type['name'];
                $text = 'You are ' . $this->tiers[$iteration]['place'] . ' ' . $equal . 'in terms of ' . $type['name'] . ' ' . $type['verb'] . '!';
                $this->characters[$character['id']]['achievements'][$achievement] = $text;
                $this->achievements[] = ['achievement' => $achievement, 'text' =>$text, 'character' => $character['name']];
            }
        }
    }
}