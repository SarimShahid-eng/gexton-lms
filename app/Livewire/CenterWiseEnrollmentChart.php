<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;
use Illuminate\Support\Facades\DB;

class CenterWiseEnrollmentChart extends Component
{
     public $centerGroupData;
  public function mount()
    {
        // join with student_registers and group by preferred_study_center
        $results = EnrollStudent::where('enroll_students.cancel_enrollment', 0)
            ->join('student_registers', 'enroll_students.cnic_number', '=', 'student_registers.cnic_number')
            ->select('student_registers.preferred_study_center', DB::raw('COUNT(*) as count'))
            ->groupBy('student_registers.preferred_study_center')
            ->get();

        $labels = $results->pluck('preferred_study_center')->toArray();
        $counts = $results->pluck('count')->toArray();

        // Generate color palette (repeat if more centers than colors)
        $backgroundColors = ['#27A486', '#41B87D', '#9ED96B', '#FFB347', '#6A5ACD', '#E9967A', '#20B2AA', '#9370DB'];
        $borderColors     = ['#1F7861', '#30B58B', '#77AA53', '#FF8C00', '#483D8B', '#CD5C5C', '#008B8B', '#4B0082'];

        $this->centerGroupData = [
            'labels' => $labels,
            'data' => $counts,
            'backgroundColor' => $backgroundColors,
            'borderColor' => $borderColors,
        ];
    }

    public function render()
    {
        return view('livewire.center-wise-enrollment-chart');
    }
}
