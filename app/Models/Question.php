<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'course_id',
        'session_id',
        'question',
        'correct_answer',
        'options'
        // 'marks',
        // 'images',
        // 'description',
        // 'desc_images',
        // 'video_link',
        // 'is_publish',
    ];

    function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    function session() {
        return $this->belongsTo(CustomSession::class, 'session_id');
    }

}
