<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discord_name'
    ];
}
