<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is an admin.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function dm(User $user)
    {
        return $user->isDm();
    }

    /**
     * Determine whether the user can update the character.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return mixed
     */
    public function owner(User $user, User $model)
    {
        return $user->isOwner($model);
    }
    
    /**
     * Determine whether a user can create a character.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return mixed
     */
    public function create(User $user, User $model)
    {
        $user_is_owner = $user->id == $model->id;
        $user_has_not_reached_character_max = !$user->reachedCharacterLimit();
        return $user_is_owner && $user_has_not_reached_character_max;
    }
}
