<?php

namespace App\Livewire;

use App\Models\BatchGroup;
use App\Models\CustomSession;
use App\Models\SubmitedTask;
use App\Models\Task;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeacherTask extends Component
{
    use WithFileUploads;
    public $teacher_id, $session_year_id, $task_title, $task_description, $assigned_task , $number_of_days, $total_marks, $attachment_link, $group_name, $id,$submitedTasksCount, $marks =[] ;
    public $submitedTasks = [];
    public function render()
    {
        $this->teacher_id = Auth::user()->id;
        $session_active = CustomSession::where('is_selected', 1)->first();
        $groups = BatchGroup::where('session_year_id', $session_active->id)->where('teacher_id', $this->teacher_id)->get();
        $this->session_year_id = $session_active->id;

        $tasks = Task::where('session_year_id', $session_active->id)->paginate(10);
        return view('livewire.teacher-task', compact('session_active', 'tasks', 'groups'));

    }
    public function save()
    {
        $rules = [
            'task_title' => 'required',
            'task_description' => 'required',
            'number_of_days' => 'required',
            'total_marks' => 'required',
            'group_name' => 'required',
        ];
        $messages = [
            'task_title.required' => 'Please enter the task title.',
            'task_description.required' => 'Please provide a description for the task.',
            'number_of_days.required' => 'Please select the number of days.',
            'total_marks.required' => 'Total marks field is required.',
            'group_name.required' => 'Please select a group.',
        ];

        $validatedData = $this->validate($rules, $messages);
        $validatedData['teacher_id'] = $this->teacher_id;
        $validatedData['session_year_id'] = $this->session_year_id;
        if ($this->attachment_link) {
            $file = $this->attachment_link;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('attachments');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $sourcePath = $file->getRealPath();
            $destinationFile = $destinationPath . DIRECTORY_SEPARATOR . $filename;
            $contents = file_get_contents($sourcePath);
            file_put_contents($destinationFile, $contents);
            $validatedData['attachment_link'] = $filename;
        }
        Task::updateOrCreate(
            ['id' => $this->id],
            $validatedData
        );

        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'task-saved',
            title: 'Success!',
            text: "Task has been $message successfully.",
            icon: 'success',
        );
    }
    public function edit($id)
    {
        $task = Task::find($id);
        $this->teacher_id = $task->teacher_id;
        $this->session_year_id = $task->session_year_id;
        $this->task_title = $task->task_title;
        $this->task_description = $task->task_description;
        $this->number_of_days = $task->number_of_days;
        $this->total_marks = $task->total_marks;
        $this->group_name = $task->group_name;
        $this->id = $id;
        $this->dispatch(
            'edit-task-loaded',
            attachment_link: $this->attachment_link,
        );
    }
    public function confirmDelete($q_id)
    {
        $this->id = $q_id;
        $this->dispatch('swal-confirm');
    }
    public function deleteCourse()
    {
        Task::destroy($this->id);
        $this->dispatch('question-deleted', title: 'Deleted!', text: 'Task has been deleted successfully.', icon: 'success');
    }
    function view_task($id)
    {
        // dd($id);
        $this->submitedTasks = collect(
            SubmitedTask::with('user')
            ->where('task_id', $id)
            ->get()
        );
        $this->submitedTasksCount = $this->submitedTasks->count();

        foreach ($this->submitedTasks as $task) {
            $this->marks[$task->id] = $task->obtain_marks;
        }

        $this->dispatch('open-task-view-modal');
    }
    public function updatedMarks($value, $key)
    {
        $task = SubmitedTask::find($key);
        if ($task) {
            $task->obtain_marks = $value;
            $task->save();
        }
        $this->dispatch(
            'marks-saved',
            title: 'Success!',
            text: "Marks has been saved  successfully.",
            icon: 'success',
        );
    }
    function update_task($id)
    {
        $this->assigned_task = 1;
        Task::where('id', $id)->update(['assigned_task' => $this->assigned_task  ]);
        $this->dispatch(
            'marks-saved',
            title: 'Success!',
            text: "Task has been Assigend successfully.",
            icon: 'success',
        );

    }

}
