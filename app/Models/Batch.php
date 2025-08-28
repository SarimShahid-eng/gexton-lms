<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        // campus_id representing batches
        'campus_id',
        'phase_id',
        'title',
        'description'
    ];
    // Campus are batches
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
