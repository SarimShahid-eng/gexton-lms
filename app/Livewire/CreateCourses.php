<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Phase;
use App\Models\TimeSlot;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCourses extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $campus_id;

    public $batches = [];

    public $campuses = [];

    public $phase_id;

    public $user_id;

    public $course_id;

    public $time_slot_id;

    public $title;

    public $description;

    public $id;

    public $batch_id;

    public $time_slot;

    public $courseIdToDelete;

    public $search = '';

    public $editMode = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $phases = Phase::get();
        $users = User::where('user_type', 'teacher')->get();
        $courses = Course::all();
        $course_details = CourseDetail::with('campus', 'batch', 'user')
            ->whereHas('course', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $time_slots = TimeSlot::all();

        return view('livewire.create-courses', compact('course_details', 'courses', 'phases', 'users', 'time_slots'));
    }

    public function updatedPhaseId($value)
    {
        $this->campuses = Campus::where('phase_id', $value)->get();
        if ($this->campus_id && ! Campus::where('id', $this->campus_id)->where('phase_id', $value)->exists()) {
            $this->campus_id = null;
            $this->batches = collect();
            $this->batch_id = null;
        }
    }

    public function updatedCampusId($value)
    {
        $this->batches = Batch::where('campus_id', $value)->where('status', 1)->get();
        if ($this->batch_id && ! Batch::where('id', $this->batch_id)->where('campus_id', $value)->where('status', 1)->exists()) {
            $this->batch_id = null;
        }
    }

    public function save()
    {

        $rules = [

            'course_id' => 'required',
            'time_slot_id' => 'required',
            'campus_id' => 'required',
            'user_id' => 'required',
            'batch_id' => 'required',
            'phase_id' => 'required',
            // 'time_slot' => 'required',
        ];
        $message = [
            'course_id.required' => 'Course is required.',
            'time_slot_id.required' => 'Time Slot is required.',
            'campus_id.required' => 'Campus is required.',
            'batch_id.required' => 'Batch is required.',
            'user_id.required' => 'Teacher is required.',
            'phase_id.required' => 'Phase is required.',
        ];
        $validated = $this->validate($rules, $message);
        unset($validated['phase_id']);
        CourseDetail::updateOrCreate(
            ['id' => $this->id],
            $validated
        );

        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'course-saved',
            title: 'Success!',
            text: "Design course has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('courses_create');
    }

    public function edit($id)
    {
        $course = CourseDetail::findOrFail($id);
        $this->id = $course->id;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->batch_id = $course->campus_id;
        $this->campus_id = $course->batch_id;
        $this->user_id = $course->user_id;
        $this->course_id = $course->course_id;
        $this->time_slot_id = $course->time_slot_id;
        // campus here denoting batches table
        $this->phase_id = $course->campus->phase_id;
        $this->editMode = true;
        // $this->campuses = Campus::where('phase_id', $this->phase_id)->get();
        // $this->batches = Batch::where('campus_id', $this->campus_id)->where('status', 1)->get();
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
        // dd($this->courseIdToDelete);

        Course::destroy($this->courseIdToDelete);
        $this->dispatch('course-deleted', title: 'Deleted!', text: 'Course has been deleted successfully.', icon: 'success');
    }
}
