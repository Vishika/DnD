<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'character_id', 'amount'
    ];
    
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
