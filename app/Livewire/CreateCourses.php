<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCourses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $campus_id, $batches= [], $user_id ,$title, $description, $id ,$batch_id, $courseIdToDelete;
    public function render()
    {
        $campuses = Campus::get();
        $users = User::where('user_type', 'teacher')->get();
        $courses = Course::with('campus','batch','user')->paginate(10);
        return view('livewire.create-courses', compact('courses', 'campuses','users'));
    }
    public function updatedCampusId($value)
    {
        $this->batches = Batch::where('campus_id', $value)
        ->where('status', 1)
        ->get();
    }
    public function save()
    {

        $rules = [
            'title' => 'required|string|max:20',
            'description' => 'string|max:200',
            'campus_id' => 'required',
            'user_id' => 'required',
            'batch_id' => 'required',
        ];
        $message = [
            'title.required' => 'Course title is required.',
            'title.max' => 'Course title may not be greater than 20 characters.',
            'description.string' => 'Course description is required.',
            'description.max' => 'Course description may not be greater than 200 characters.',
            'campus_id.required' => 'Campus is required.',
            'batch_id.required' => 'Batch is required.',
            'user_id.required' => 'Teacher is required.',
        ];
        $validated = $this->validate($rules, $message);
        Course::updateOrCreate(
            ['id' => $this->id],
            $validated
        );

        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'course-saved',
            title: 'Success!',
            text: "Course has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('courses_create');
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $this->id = $course->id;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->campus_id = $course->campus_id;
        $this->batch_id = $course->batch_id;
        $this->user_id = $course->user_id;
    }
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $this->course_title = $course->course_title;
        $this->course_description = $course->course_description;
        $this->questions_limit = $course->questions_limit;
        [$hours, $minutes, $seconds] = explode(':', $course->test_time);
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->Duration = $course->Duration;
        $this->update_id = $course->id;
    }
    public function confirmDelete($courseId)
    {
        $this->courseIdToDelete = $courseId;
        $this->dispatch('swal-confirm');
    }
    public function deleteCourse()
    {
        // dd($this->courseIdToDelete);

        Course::destroy($this->courseIdToDelete);
        $this->dispatch('course-deleted', title: 'Deleted!', text: 'Course has been deleted successfully.', icon: 'success');
    }
}
