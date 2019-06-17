<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is a dm.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function dm(User $user)
    {
        return $user->isDm();
    }
    
    /**
     * Determine whether the user is an admin.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function admin(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user is the owner.
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
     * Determine whether the user access basic function.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return mixed
     */
    public function access(User $user, User $model)
    {
        return $user->isOwner($model) || $user->isDm();
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
    
    /**
     * Determine whether a user can contribute.
     *
     * @param  \App\User  $user
     * @param  \App\Character  $character
     * @return mixed
     */
    public function contribute(User $user, User $model)
    {
        $user_is_owner = $user->isOwner($model);
        $contritbutions = DB::table('features')->where('name', '=', 'contributions')->where('active', '=', 1)->get();
        return $user_is_owner && $contritbutions->isNotEmpty();
    }
}
