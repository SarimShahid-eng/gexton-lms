<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestMark extends Model
{
    protected $fillable = [
        'wrong_ans',
        'correct_ans',
        'total_questions',
        'percentage',
        'session_id',
        'student_id',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
