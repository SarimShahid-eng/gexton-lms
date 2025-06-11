<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'campus_id',
        'batch_id'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
