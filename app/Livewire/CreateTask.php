<?php

namespace App\Livewire;

use App\Models\StudentDetail;
use App\Models\Task;
use Auth;
use Livewire\Component;

class CreateTask extends Component
{
    public $task_title, $task_description, $number_of_days, $attachment_link, $group_name;
    public function render()
    {

        $user = Auth::user();
        // dd($user);
        $studentDetail = $user->student_details()->where('result', 'pass')->first();

        if ($studentDetail) {
            $tasks = $studentDetail->tasks()
                ->with('task_marks')
                ->where('assigned_task', 1)
                ->get();

            // dd($tasks);
        } else {
            $tasks = collect();
        }

        // dd($tasks);

        return view('livewire.create-task', compact('tasks'));
    }
    function view_task($id)
    {
        $task_detail = Task::where('id', $id)->firstOrFail();
        $this->task_title = $task_detail->task_title;
        $this->task_description = $task_detail->task_description;
        $this->number_of_days = $task_detail->number_of_days;
        $this->attachment_link = $task_detail->attachment_link;
        $this->dispatch('open-task-view-modal');
    }
}
