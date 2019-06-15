<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }
}
