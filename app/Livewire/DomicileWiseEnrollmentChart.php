<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;
use Illuminate\Support\Facades\DB;

class DomicileWiseEnrollmentChart extends Component
{
     public $domicileGroupData;

    public function mount()
    {
        $results = EnrollStudent::where('enroll_students.cancel_enrollment', 0)
            ->join('student_registers', 'enroll_students.cnic_number', '=', 'student_registers.cnic_number')
            ->select('student_registers.domicile_category', DB::raw('COUNT(*) as count'))
            ->groupBy('student_registers.domicile_category')
            ->get();

        $labels = $results->pluck('domicile_category')->toArray();
        $counts = $results->pluck('count')->toArray();

        // Assign colors (urban, rural, etc.)
        $backgroundColors = ['#27A486', '#41B87D', '#9ED96B', '#FFB347'];
        $borderColors     = ['#1F7861', '#30B58B', '#77AA53', '#FF8C00'];

        $this->domicileGroupData = [
            'labels' => $labels,
            'data' => $counts,
            'backgroundColor' => $backgroundColors,
            'borderColor' => $borderColors,
        ];
    }
    public function render()
    {
        return view('livewire.domicile-wise-enrollment-chart');
    }
}
