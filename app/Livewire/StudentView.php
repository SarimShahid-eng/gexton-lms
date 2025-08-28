<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;


class StudentView extends Component
{
    protected $paginationTheme = 'tailwind';
    use WithPagination;

    public $course_id = null;
    public function render()
    {
        $courses = Auth::user()->courses()->with('batch')->get();
        // dd($courses);
        $students = [];

        if ($this->course_id != null) {
            $students = User::where('user_type', 'student')
                ->whereHas('student_detail.enroll', function ($query) {
                    $query->where('course_id', $this->course_id);
                })
                ->with('student_detail.enroll')
                ->paginate(10);
        }
        return view('livewire.student-view', compact('courses','students'));
    }

    public function updatedCourseId($value)
    {
        $this->course_id = $value;
    }


}
