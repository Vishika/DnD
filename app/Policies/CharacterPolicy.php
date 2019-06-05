<?php

namespace App\Policies;

use App\User;
use App\Character;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manipulate the character.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return mixed
     */
    public function owner(User $user, Character $character)
    {
        return $character->user_id == $user->id;
    }
}
