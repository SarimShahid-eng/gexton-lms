<?php

namespace App\Livewire;

use App\Models\SubmitedTask;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class UploadTask extends Component
{
    use WithFileUploads;
    public $task_id,
    $description,
    $attachment_link,
    $id;
    public function render()
    {
        $user = auth()->user();
        // dd($user);
        $studentDetail = $user->student_details()->where('result', 'pass')->first();

        if ($studentDetail) {
            $tasks = $studentDetail->tasks()
                ->where('assigned_task', 1)
                ->whereDoesntHave('update_task')
                ->get();
            ;
        } else {
            $tasks = collect();
        }
        return view('livewire.upload-task', compact('tasks'));
    }
    function save()
    {
        $validatedData = $this->validate([
            'task_id' => 'required|exists:tasks,id',
            'description' => 'required|string|max:255',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
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
        $existingSubmission = SubmitedTask::where('user_id', auth()->id())
            ->where('task_id', $this->task_id)
            ->first();

        if ($existingSubmission) {
            $message = 'Your Task Has Already Been Submitted';
        } else {
            SubmitedTask::create($validatedData);
            $message = 'Your Task Has Been Submitted';
        }
        $this->reset();
        $this->dispatch(
            'task-saved',
            title: 'Success!',
            text: $message,
            icon: 'success',
        );
    }
}
