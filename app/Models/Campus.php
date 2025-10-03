<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campus extends Model
{
    use HasFactory;
    //
    protected $fillable = ['title', 'description','phase_id'];
    function phase ()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
    function campus()
    {
        return $this->hasOne(Batch::class,'campus_id','id');
    }
}
