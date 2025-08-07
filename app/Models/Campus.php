<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    //
    protected $fillable = ['title', 'description','phase_id'];
    function phase ()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
