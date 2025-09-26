<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;
use Illuminate\Support\Facades\DB;

class StudentEducationBackgroundChart extends Component
{
    public $educationGroupData;

    public function mount()
    {
        // Define the education level labels to match the user's requested chart image
        $labels = ['Matric', 'Intermediate', 'Graduate'];
        $educationGroups = array_fill_keys($labels, 0);

        // Perform a join query to get the highest_qualification of enrolled students
        // where cancel_enrollment is 0
        $results = EnrollStudent::where('enroll_students.cancel_enrollment', 0)
            ->join('student_registers', 'enroll_students.cnic_number', '=', 'student_registers.cnic_number')
            ->select(DB::raw('student_registers.highest_qualification'), DB::raw('COUNT(*) as count'))
            ->groupBy('student_registers.highest_qualification')
            ->get();

        // Map the database results to the predefined education group array
        foreach ($results as $result) {
            $qualification = strtolower($result->highest_qualification);
            switch ($qualification) {
                case 'matric':
                    $educationGroups['Matric'] = $result->count;
                    break;
                case 'intermediate':
                    $educationGroups['Intermediate'] = $result->count;
                    break;
                case 'graduate':
                    $educationGroups['Graduate'] = $result->count;
                    break;
            }
        }

        // Format the data for Chart.js
        $this->educationGroupData = [
            'labels' => array_keys($educationGroups),
            'data' => array_values($educationGroups),
            'backgroundColor' => ['#27A486', '#41B87D', '#9ED96B'],
            'borderColor' => ['#1F7861', '#30B58B', '#77AA53'],
        ];
    }

    public function render()
    {
        return view('livewire.student-education-background-chart');
    }
}
