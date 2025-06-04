<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
        'group_id',
        'course_id',
        'suspend_date',
        'reason_suspend',
        'result',
        'entry_test',
        'test_countdown',
        'timer_started'
    ];
    protected $casts = [
        'entry_test' => 'boolean',
        'timer_started'=>'boolean'
    ];
    // as entry test got completed entry_test will get true
    // result will generate from In_progress to other
    // test_countdown will keep the count of student he has reached so far
    // on load and on option submit test_countdown updating then user will continue from that time
    // as user submits the answer
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function group()
    {
        return $this->belongsTo(BatchGroup::class, 'group_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'group_name', 'group_id');
    }
}
