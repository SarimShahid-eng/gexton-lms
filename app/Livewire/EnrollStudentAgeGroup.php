<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;
use Illuminate\Support\Facades\DB;

class EnrollStudentAgeGroup extends Component
{
    public $ageGroupData;

   public function mount()
    {
        // 1. Define the age group labels (bins)
        $labels = ['18-24', '25-34', '35-44', '45-54', '55+'];
        $ageGroups = array_fill_keys($labels, 0); // Initialize counts to zero

        // 2. Efficiently calculate age and count per group using DB query (MySQL/PostgreSQL compatible)
        // This calculates the age difference and groups the results directly in the database.
        $results = EnrollStudent::select(DB::raw('
            CASE
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 18 AND 24 THEN "18-24"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 25 AND 34 THEN "25-34"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 35 AND 44 THEN "35-44"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 45 AND 54 THEN "45-54"
                ELSE "55+"
            END as age_group_label
        '), DB::raw('COUNT(*) as count'))
        ->groupBy('age_group_label')
        ->get();

        // 3. Map the database results back to the age group array
        foreach ($results as $result) {
            if (array_key_exists($result->age_group_label, $ageGroups)) {
                $ageGroups[$result->age_group_label] = $result->count;
            }
        }

        // 4. Format the data for Chart.js
        $this->ageGroupData = [
            'labels' => array_keys($ageGroups),
            'data' => array_values($ageGroups),
            'backgroundColor' => ['#4BC0C0'],
            'borderColor' => ['#3182CE'],
        ];
    }

    public function render()
    {
        return view('livewire.enroll-student-age-group');
    }
}
