<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    private static $levels = [
        3 => 0,
        4 => 2700,
        5 => 6500,
        6 => 14000,
        7 => 23000,
        8 => 34000,
        9 => 48000,
        10 => 64000,
        11 => 85000,
        12 => 100000,
        13 => 120000,
        14 => 140000,
        15 => 165000,
        16 => 195000,
        17 => 225000,
        18 => 265000,
        19 => 305000,
        20 => 355000
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'race', 'class', 'active'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'gold', 'experience', 'level'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sessionCharacters()
    {
        return $this->hasMany(SessionCharacter::class);
    }
    
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
    
    public function addSession($experience, $gold)
    {
        $this->attributes['experience'] += $experience;
        $this->attributes['gold'] += $gold;
        $this->updateLevel();
    }
    
    public function spend($amount)
    {
        $this->attributes['gold'] -= $amount;
    }
    
    public function spendToGainExperience($amount)
    {
        $this->attributes['gold'] -= $amount;
        $this->attributes['experience'] += $amount;
        $this->updateLevel();
    }
    
    private function updateLevel()
    {
        foreach (self::$levels as $level => $xpThreshold)
        {
            if ($this->attributes['experience'] >= $xpThreshold)
            {
                $this->attributes['level'] = $level;
            }
        }
    }
}
