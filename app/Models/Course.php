<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'campus_id',
        'batch_id',
        'description'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
