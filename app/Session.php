<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'created_at', 'user_id', 'duration', 'difficulty', 'encounters', 'note'
    ];
    
    public function sessionCharacters()
    {
        return $this->hasMany(SessionCharacter::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
