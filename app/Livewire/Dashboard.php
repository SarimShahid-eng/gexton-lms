<?php

namespace App\Livewire;

use App\Models\EnrollStudentDetail;
use App\Models\User;
use App\Models\Course;
use Auth;
use Livewire\Component;
use App\Models\BatchGroup;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $enrollments = [];
    public function render()
    {
        if (Auth::user()->user_type  == 'student') {
            $this->enrollments = EnrollStudentDetail::where('student_id', Auth::user()->id)->get();
        }

        return view('livewire.dashboard');
    }
}
