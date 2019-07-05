<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'user_id', 'character_id', 'tentative', 'dm'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}