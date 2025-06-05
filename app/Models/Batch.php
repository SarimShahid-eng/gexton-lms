<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'campus_id',
        'title',
        'description'
    ];
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
