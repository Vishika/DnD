<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'discord_name', 'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
      
    public function characters()
    {
        return $this->hasMany(Character::class);
    }
    
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    
    public function isAdmin() {
        return $this->role == 'admin';
    }
    
    public function isDm() {
        return $this->role == 'dm' || $this->role == 'admin';
    }
    
    public function isPlayer() {
        return $this->role == 'player';
    }
    
    public function isOwner(User $model)
    {
        return $this->id == $model->id;
    }

    /**
     * This function returns whether the user is elligible to create or activate more characters.
     * 
     * @return boolean
     */
    public function reachedCharacterLimit()
    {
        $characters = $this->characters;
        $max_character_level = 0;
        $active_characters = 0;
        $max_allowed_characters = 1;
        foreach ($characters as $character)
        {
            if ($character['level'] > $max_character_level)
            {
                $max_character_level = $character['level'];
            }
            if ($character['level'] == 20)
            {
                $max_allowed_characters++;
            }
            if ($character['active'])
            {
                $active_characters++;
            }
        }
        if ($max_character_level >= 5)
        {
            $max_allowed_characters++;
        }
        if ($max_character_level >= 11)
        {
            $max_allowed_characters++;
        }
        if ($max_character_level >= 17)
        {
            $max_allowed_characters++;
        }
        return $active_characters >= $max_allowed_characters;
    }
}
