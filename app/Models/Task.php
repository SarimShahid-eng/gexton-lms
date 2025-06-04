<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'session_year_id',
        'teacher_id',
        'task_title',
        'task_description',
        'number_of_days',
        'total_marks',
        'attachment_link',
        'group_name',
    ];

    function session() {
        return $this->belongsTo(CustomSession::class, 'session_year_id');
    }
    function group() {
        return $this->belongsTo(BatchGroup::class, 'group_name');
    }
    function task_marks() {
        return $this->hasOne(SubmitedTask::class, 'task_id')
                ->where('user_id', auth()->user()->id);
    }
    function update_task() {
        return $this->hasOne(SubmitedTask::class, 'task_id')
                ->where('user_id', auth()->user()->id);
    }
}
