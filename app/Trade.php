<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'character_id', 'gold', 'note'
    ];
    
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
