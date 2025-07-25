<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollStudentDetail extends Model
{
    protected $fillable = [
        'student_id',
        'campus_id',
        'batch_id',
        'course_id',
    ];
    public function student()
    {
        return $this->belongsTo(EnrollStudent::class, 'student_id');
    }
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
