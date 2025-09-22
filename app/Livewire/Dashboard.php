<?php

namespace App\Livewire;

use Auth;
use App\Models\User;
use App\Models\Batch;
use App\Models\Phase;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\StudentRegister;
use App\Models\EnrollStudentDetail;

class Dashboard extends Component
{
    public $enrolledstudentsCount;

    public $registeredtudentsCount;

    public $teachersCount;

    public $coursesCount;

    public $phasesCount;

    public $campusCount;

    public $batchesCount;

    public $enrollments = [];

    public function mount()
    {
        $query = User::query();
        $this->enrolledstudentsCount = (clone $query)
            ->where('user_type', 'student')
            ->count();
        $this->registeredtudentsCount = StudentRegister::count();
        $this->teachersCount = (clone $query)
            ->where('user_type', 'teacher')
            ->count();
        $this->phasesCount = Phase::count();
        $this->batchesCount = Campus::count();
        $this->campusCount = Batch::count();
        $this->coursesCount = Course::count();

    }

    public function render()
    {
        //  $genderCounts = StudentRegister::selectRaw('gender, COUNT(*) as total')
        // ->groupBy('gender')
        // ->pluck('total', 'gender');

        // dd($genderCounts);
        if (Auth::user()->user_type == 'student') {
            $this->enrollments = EnrollStudentDetail::where('student_id', Auth::user()->id)->get();
        }

        return view('livewire.dashboard');
    }
}
