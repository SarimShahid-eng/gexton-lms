<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'campus_id',
        'phase_id',
        'title',
        'description'
    ];
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
