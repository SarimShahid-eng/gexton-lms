<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'teacher_id',
        'from',
        'to',
        'session_year_id',
        'group_name',
        'is_completed',
    ];

    protected $casts = [
        'from' => 'datetime:H:i',
        'to' => 'datetime:H:i',
        'is_completed' => 'boolean',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function sessionYear()
    {
        return $this->belongsTo(CustomSession::class);
    }
}
