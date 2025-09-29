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
        $labels = [
            'Below 18',
            '18-20',
            '21-22',
            '23-24',
            '25-26',
            '27-28'
        ];
        $ageGroups = array_fill_keys($labels, 0);

        $results = EnrollStudent::select(DB::raw('
            CASE
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 18 THEN "Below 18"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 18 AND 20 THEN "18-20"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 21 AND 22 THEN "21-22"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 23 AND 24 THEN "23-24"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 25 AND 26 THEN "25-26"
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 27 AND 28 THEN "27-28"
                ELSE "Other"
            END as age_group_label
        '), DB::raw('COUNT(*) as count'))
        ->groupBy('age_group_label')
        ->get();

        // 3️⃣ Map the database results back to your array
        foreach ($results as $result) {
            if (array_key_exists($result->age_group_label, $ageGroups)) {
                $ageGroups[$result->age_group_label] = $result->count;
            }
        }

        // 4️⃣ Chart.js-friendly data
        $this->ageGroupData = [
            'labels' => array_keys($ageGroups),
            'data' => array_values($ageGroups),
            'backgroundColor' => [
                '#4BC0C0', '#36A2EB', '#FFCE56', '#FF6384', '#9966FF', '#FF9F40'
            ],
            'borderColor' => [
                '#3182CE', '#2B6CB0', '#C05621', '#9B2C2C', '#553C9A', '#744210'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.enroll-student-age-group');
    }
}
