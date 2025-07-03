<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course as StudentCourse;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomSession;
use Livewire\WithoutUrlPagination;

class Course extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $campus_id, $batches= [], $title, $description, $id ,$batch_id;
    public function render()
    {
        $campuses = Campus::get();
        $courses = StudentCourse::with('campus','batch')->paginate(10);
        return view('livewire.course', compact('courses', 'campuses'));
    }
    public function updatedCampusId($value)
    {
        $this->batches = Batch::where('campus_id', $value)->get();
    }
    public function save()
    {

        $rules = [
            'title' => 'required|string|max:20',
            'description' => 'string|max:200',
            'campus_id' => 'required',
            'batch_id' => 'required',
        ];
        $message = [
            'title.required' => 'Course title is required.',
            'title.max' => 'Course title may not be greater than 20 characters.',
            'description.string' => 'Course description is required.',
            'description.max' => 'Course description may not be greater than 200 characters.',
            'campus_id.required' => 'Campus is required.',
            'batch_id.required' => 'Batch is required.',
        ];
        $validated = $this->validate($rules, $message);
        StudentCourse::updateOrCreate(
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
        $course = StudentCourse::findOrFail($id);
        $this->id = $course->id;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->campus_id = $course->campus_id;
        $this->batch_id = $course->batch_id;
    }
    // public function delete($id)
    // {
    //     $course = Course::findOrFail($id);
    //     $this->course_title = $course->course_title;
    //     $this->course_description = $course->course_description;
    //     $this->questions_limit = $course->questions_limit;
    //     [$hours, $minutes, $seconds] = explode(':', $course->test_time);
    //     $this->hours = $hours;
    //     $this->minutes = $minutes;
    //     $this->Duration = $course->Duration;
    //     $this->update_id = $course->id;
    // }
    public function confirmDelete($courseId)
    {
        $this->courseIdToDelete = $courseId;
        $this->dispatch('swal-confirm');
    }
    public function deleteCourse()
    {
        StudentCourse::destroy($this->courseIdToDelete);
        $this->dispatch('course-deleted', title: 'Deleted!', text: 'Course has been deleted successfully.', icon: 'success');
    }
}
