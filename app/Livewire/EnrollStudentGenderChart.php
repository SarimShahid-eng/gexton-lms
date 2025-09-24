<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;

class EnrollStudentGenderChart extends Component
{
     public $enrollmentData;
       public function mount()
    {
        $baseQuery=EnrollStudent::where('cancel_enrollment',0);
        $maleCount=(clone $baseQuery)->where('gender','male')->count();
        $femaleCount=(clone $baseQuery)->where('gender','female')->count();
        $transgender=(clone $baseQuery)->where('gender','transgender')->count();

        $this->enrollmentData = [
            'labels' => ['Male', 'Female', 'Transgender'],
            'data' => [$maleCount, $femaleCount, $transgender],
            'backgroundColor' => ['#4BC0C0', '#FF6384', '#FFCE56'],
        ];
    }
    public function render()
    {
        return view('livewire.enroll-student-gender-chart');
    }
}
