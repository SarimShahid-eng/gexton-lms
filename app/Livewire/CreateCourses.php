<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomSession;
use Livewire\WithoutUrlPagination;

class CreateCourses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $course_title, $course_description, $Duration, $created_date, $session_year_id, $test_time, $questions_limit, $minutes, $update_id, $courseIdToDelete;
    public function render()
    {
        $session_active = CustomSession::where('is_selected', 1)->first();
        $this->session_year_id = $session_active->id;
        $courses = Course::paginate(10);
        return view('livewire.create-courses', compact('courses', 'session_active'));
    }
    public function convertMinutesToTime($totalMinutes)
    {
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' .
            str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':00';
    }
    public function save()
    {
        $validated = $this->validate([
            'course_title' => 'required',
            'course_description' => 'required',
            'minutes' => 'required',
            'Duration' => 'required',
            'created_date' => 'nullable',
            'session_year_id' => 'required',
            'test_time' => 'nullable',
            'questions_limit' => 'required',
        ]);

        $validated['test_time'] = $this->convertMinutesToTime($this->minutes);
        $validated['created_date'] = now();
        Course::updateOrCreate(
            ['id' => $this->update_id],
            $validated
        );

        $message = $this->update_id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'course-saved',
            title: 'Success!',
            text: "Course has been $message successfully.",
            icon: 'success',
        );
    }
    public function timeToMinutes($time)
    {
        [$hours, $minutes, $seconds] = explode(':', $time);
        return ((int)$hours * 60) + (int)$minutes;
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $this->course_title = $course->course_title;
        $this->course_description = $course->course_description;
        $this->questions_limit = $course->questions_limit;

        $minutes = $this->timeToMinutes($course->test_time);
        $this->minutes = $minutes;
        $this->Duration = $course->Duration;
        $this->update_id = $course->id;
    }
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $this->course_title = $course->course_title;
        $this->course_description = $course->course_description;
        $this->questions_limit = $course->questions_limit;
        $this->minutes = $this->timeToMinutes($course->test_time);
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
        Course::destroy($this->courseIdToDelete);
        $this->dispatch('course-deleted', title: 'Deleted!', text: 'Course has been deleted successfully.', icon: 'success');
    }
}
