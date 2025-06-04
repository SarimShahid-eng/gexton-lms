<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_title',
        'course_description',
        'Duration',
        'created_date',
        'session_year_id',
        'test_time',
        'questions_limit'
    ];
}
