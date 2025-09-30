<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use App\Models\EnrollStudent;
use App\Models\EnrollStudentDetail;
use App\Models\Phase;
use App\Models\StudentRegister;
use App\Models\User;
use Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $enrolledstudentsCount;

    public $registeredtudentsCount;

    public $teachersCount;

    public $coursesCount;

    public $phasesCount;

    public $campusCount;

    public $genderCounts;

    public $batchesCount;

    public $enrollments = [];

    public $courses;

    public $center;

    public $domicile;

    public $urbanRural;

    public $study_center_filter;

    public $course_filter;

    public $gender_filter;

    public $domicile_category_filter;

    public function mount()
    {

        $query = User::query();
        $this->genderCounts = StudentRegister::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total', 'gender');
        $this->enrolledstudentsCount = EnrollStudent::where('cancel_enrollment', 0)->count();
        $this->registeredtudentsCount = StudentRegister::count();
        $this->teachersCount = (clone $query)
            ->where('user_type', 'teacher')
            ->count();
        $this->phasesCount = Phase::count();
        $this->batchesCount = Campus::count();
        $this->campusCount = Batch::count();
        $this->coursesCount = Course::count();
        $this->courses = Course::all();
    }

    public function updatedStudyCenterFilter($value)
    {
        $enrolledstudentsCount = EnrollStudent::whereHas('registered_student', function ($q) use ($value) {
            $q->where('preferred_study_center', $value);
        })->get();
        $this->enrolledstudentsCount = $enrolledstudentsCount->count();
    }

    // public function updatedDomicileCategoryFilter($value) {}

    // public function updatedGenderFilter($value) {}

    // public function updatedCourseFilter($value) {}

    public function render()
    {
        if (Auth::user()->user_type == 'student') {
            $this->enrollments = EnrollStudentDetail::where('student_id', Auth::user()->id)->get();
        }
        return view('livewire.dashboard');
    }
}
