<?php

namespace App\Charts;

use App\Character;
use App\Session;

class PartyChart extends DndChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($playersCharacter)
    {
        parent::__construct();
        $characterId = $playersCharacter->id;
        $sessions = Session::all();
        $charactersPlayedWith = array();
        // find all the sessions the character was ever in (not as a dm) and get the ids of the characters they played with
        foreach ($sessions as $session) {
            $party = array();
            foreach ($session->sessionCharacters as $sessionCharacter) {
                if (!$sessionCharacter->dm) {
                    $party[] = $sessionCharacter->character_id;
                }
            }
            if (in_array($characterId, $party)) {
                foreach($party as $member) {
                    if (array_key_exists($member, $charactersPlayedWith)) {
                        $charactersPlayedWith[$member]++;
                    } else {
                        $charactersPlayedWith[$member] = 1;
                    }
                }
            }
        }
        $charactersPlayedWith = collect($charactersPlayedWith);
        // find out everyones name and level from their id
        $characters = Character::all();
        $charactersInfo = array();
        foreach ($characters as $character) {
            $charactersInfo[$character->id]['name'] = $character->name;
            $charactersInfo[$character->id]['level'] = $character->level;
            $charactersInfo[$character->id]['experience'] = $character->experience;
            $charactersInfo[$character->id]['gold'] = 0;
            $charactersInfo[$character->id]['played'] = 0;
        }
        foreach ($charactersPlayedWith as $partyMemberId => $sessionsPlayedWith) {
            $charactersInfo[$partyMemberId]['played'] = $sessionsPlayedWith;
        }
        $partySize = 8;
        // pick the top x many characters this character has played with
        $party = collect($charactersInfo)->whereNotIn('played', [0])->sortBy('played')->reverse()->take($partySize);
        // in some cases a friend may have played every game with you, but we want the main character to be first in the list
        $mainCharacter = $party->pull($characterId);
        $party->prepend($mainCharacter);
        $this->labels($party->pluck('name'));
        $chartType = 'bar';
        $this->dataset('Experience', $chartType, $party->pluck('experience'))->options($this->getBloodColours());
        $this->minimalist(true);
    }
}
