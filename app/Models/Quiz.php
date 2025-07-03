<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'batch_id', 'teacher_id', 'campus_id', 'course_id', 'description', 'marks', 'duration'];

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
