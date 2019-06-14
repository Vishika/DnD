<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionCharacter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session_id', 'character_id', 'difficulty', 'duration', 'encounters', 'experience', 'gold', 'dm', 'note', 'created_at'
    ];
    
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
